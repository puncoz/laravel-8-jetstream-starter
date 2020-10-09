<?php

namespace App\Data\Models\Entities;

use Carbon\Carbon;
use Spatie\Permission\Models\Permission as BasePermission;

/**
 * Class Permission
 * @package App\Data\Models\Entities
 *
 * @property int    $id
 * @property string $name
 * @property string $guard_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Permission extends BasePermission
{

}
