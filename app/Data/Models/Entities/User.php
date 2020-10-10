<?php

namespace App\Data\Models\Entities;

use App\Constants\DBTables;
use App\Data\Models\Accessors\UserAccessors;
use App\Data\Models\Traits\Loggable;
use App\Data\Models\Traits\UserInfo;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Hashing\HashManager;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * @package App\Data\Models\Entities
 *
 * @property int         $id
 * @property string      $name
 * @property string      $email
 * @property string      $username
 * @property string      $password
 * @property Carbon|null $email_verified_at
 * @property string|null $profile_photo_path
 * @property object|null $metadata
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 * @property Carbon|null $deleted_at
 * @property string|null $two_factor_secret
 * @property string      $two_factor_recovery_codes
 *
 * @property Collection  $roles
 * @property Collection  $owned_teams
 *
 * @property string      $display_name
 * @property Role|null   $primary_role
 * @property bool        $is_admin
 * @property string      $profile_photo_url
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use SoftDeletes;
    use UserInfo;
    use Loggable;
    use UserAccessors;

    /**
     * @var string
     */
    protected $table = DBTables::AUTH_USERS;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'metadata',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'metadata' => 'object',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected $dates = [
        'email_verified_at',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory()
    {
        return UserFactory::new();
    }

    /**
     * @param string $password
     *
     * @throws BindingResolutionException
     */
    public function setPasswordAttribute(string $password)
    {
        /** @var HashManager $hashManager */
        $hashManager                  = app()->make(HashManager::class);
        $this->attributes['password'] = $hashManager->needsRehash($password) ? $hashManager->make($password)
            : $password;
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function profilePhotoDisk()
    {
        return config('config.default_disk');
    }
}
