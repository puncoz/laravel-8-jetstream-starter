<?php

namespace App\Data\Repositories\User;

use App\Data\Models\Entities\Role;
use App\Data\Repositories\Repository;

/**
 * Class RoleEloquentRepository
 * @package App\Data\Repositories\User
 */
class RoleEloquentRepository extends Repository implements RoleRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Role::class;
    }
}
