<?php

namespace App\Data\Repositories\User;

use App\Data\Repositories\RepositoryInterface;

/**
 * Interface UserRepository
 * @package App\Data\Repositories\User
 */
interface UserRepository extends RepositoryInterface
{
    /**
     * @param string $roleName
     *
     * @return UserRepository
     */
    public function byRole(string $roleName): UserRepository;
}
