<?php

namespace App\Data\Repositories\User;

use App\Data\Models\Entities\Permission;
use App\Data\Repositories\Repository;

/**
 * Class PermissionEloquentRepository
 * @package App\Data\Repositories\User
 */
class PermissionEloquentRepository extends Repository implements PermissionRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }
}
