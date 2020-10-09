<?php

namespace App\Data\Models\Entities;

use Carbon\Carbon;
use Spatie\Permission\Models\Role as BaseRole;

/**
 * Class Role
 * @package App\Data\Models\Entities
 *
 * @property int    $id
 * @property string $name
 * @property string $guard_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Role extends BaseRole
{

}
