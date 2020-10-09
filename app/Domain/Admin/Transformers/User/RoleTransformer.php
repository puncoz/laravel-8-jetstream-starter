<?php

namespace App\Domain\Admin\Transformers\User;

use App\Data\Models\Entities\Role;
use Illuminate\Support\Str;
use League\Fractal\TransformerAbstract;

/**
 * Class RoleTransformer
 * @package App\Domain\Admin\Transformers\User
 */
class RoleTransformer extends TransformerAbstract
{
    /**
     * @param Role $role
     *
     * @return array
     */
    public function transform(Role $role): array
    {
        return [
            'id'         => $role->id,
            'name'       => $role->name,
            'label'      => Str::title($role->name),
            'guard_name' => $role->guard_name,
        ];
    }
}
