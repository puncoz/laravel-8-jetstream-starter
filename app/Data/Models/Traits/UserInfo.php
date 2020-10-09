<?php

namespace App\Data\Models\Traits;

use App\Data\Models\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait UserInfo
 * @package App\Data\Models\Traits
 */
trait UserInfo
{
    /**
     * Boot method for creating, updating and deleting models.
     */
    public static function bootUserInfo()
    {
        static::creating(
            function ($model) {
                /** @var Model $model */
                $model->setAttribute('created_by', currentUser() ? currentUser()->id : null);
            }
        );

        static::updating(
            function ($model) {
                /** @var Model $model */
                $model->setAttribute('updated_by', currentUser() ? currentUser()->id : null);
            }
        );

        static::deleting(
            function ($model) {
                /** @var Model $model */
                $model->setAttribute('deleted_by', currentUser() ? currentUser()->id : null)->save();
            }
        );
    }

    /**
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function destroyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }
}
