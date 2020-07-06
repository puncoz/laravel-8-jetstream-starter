<?php

namespace App\Data\Repositories\User\Role;

use App\Core\BaseClasses\Repository\RepositoryInterface;
use App\Data\Entities\User\Role;
use Illuminate\Support\Collection;
use Spatie\Permission\Exceptions\RoleDoesNotExist;

/**
 * Interface RoleRepository
 * @package App\Data\Repositories\User\Role
 */
interface RoleRepository extends RepositoryInterface
{
    /**
     * @param string      $roleName
     * @param string|null $guardName
     *
     * @return Role|array
     * @throws RoleDoesNotExist
     */
    public function findByName(string $roleName, ?string $guardName = null);

    /**
     * Return role collection except
     * @param string|array $role
     * @param string|null  $guardName
     * @return Collection
     */
    public function allExcept($role, ?string $guardName = null): Collection;
}
