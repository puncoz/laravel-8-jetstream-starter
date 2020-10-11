<?php

namespace App\Data\Models\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * Trait Loggable
 * @package App\Data\Models\Traits
 */
trait Loggable
{
    /**
     * Boot method for creating, updating and deleting models.
     */
    public static function bootLoggable()
    {
        static::created(
            function ($model) {
                /** @var Model $model */
                $description = sprintf("%s_added", class_basename(get_class($model)));
                $causer      = currentUser() ? currentUser()->id : null;
                $subject     = $model;
                $properties  = $model->toArray();

                logActivity($description, $causer, $subject, $properties);
            }
        );

        static::updated(
            function ($model) {
                /** @var Model $model */
                $description = sprintf("%s_updated", class_basename(get_class($model)));
                $causer      = currentUser() ? currentUser()->id : null;
                $subject     = $model;
                $properties  = $model->toArray();

                logActivity($description, $causer, $subject, $properties);
            }
        );

        static::deleted(
            function ($model) {
                /** @var Model $model */
                $description = sprintf("%s_deleted", class_basename(get_class($model)));
                $causer      = currentUser() ? currentUser()->id : null;
                $subject     = $model;

                logActivity($description, $causer, $subject);
                logger()->info(sprintf("%s deleted", get_class($model)), $model->toArray());
            }
        );
    }
}
