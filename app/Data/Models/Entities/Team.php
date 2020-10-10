<?php

namespace App\Data\Models\Entities;

use App\Constants\DBTables;
use App\Data\Models\Traits\Loggable;
use App\Data\Models\Traits\UserInfo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

/**
 * Class Team
 * @package App\Data\Models\Entities
 *
 * @property int         $id
 * @property int         $user_id
 * @property string      $name
 * @property bool        $personal_team
 * @property object      $metadata
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 * @property Carbon|null $deleted_at
 */
class Team extends JetstreamTeam
{
    use SoftDeletes;
    use UserInfo;
    use Loggable;

    /**
     * @var string
     */
    protected $table = DBTables::AUTH_TEAMS;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'personal_team',
        'metadata',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'personal_team' => 'boolean',
        'metadata'      => 'object',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];
}
