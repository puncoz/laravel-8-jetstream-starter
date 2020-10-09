<?php

namespace App\Data\Repositories\User;

use App\Data\Models\Entities\User;
use App\Data\Repositories\Repository;

/**
 * Class UserEloquentRepository
 * @package App\Data\Repositories\User
 */
class UserEloquentRepository extends Repository implements UserRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @param string $roleName
     *
     * @return $this
     */
    public function byRole(string $roleName): self
    {
        $this->model = $this->model->role($roleName);

        return $this;
    }
}
