<?php

namespace Database\Seeders\Seeders;

use App\Constants\AuthRolesPermissions;
use App\Data\Models\Entities\Role;
use App\Data\Repositories\User\RoleRepository;
use Illuminate\Database\Seeder;

/**
 * Class RolesSeeder
 * @package Database\Seeders\Seeders
 */
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param RoleRepository $roleRepository
     *
     * @return void
     */
    public function run(RoleRepository $roleRepository)
    {
        collect(AuthRolesPermissions::ROLES())->each(
            function (string $roleName) use ($roleRepository) {
                /** @var Role $role */
                $role = $roleRepository->updateOrCreate(['name' => $roleName]);

                if ( $roleName === AuthRolesPermissions::ROLE_ADMIN ) {
                    $role->syncPermissions(AuthRolesPermissions::PERMISSIONS());

                    return;
                }

                $permissionsByRole = config("static-data.role-permissions-mapping.{$roleName}");
                if ( $permissionsByRole && is_array($permissionsByRole) ) {
                    $role->syncPermissions($permissionsByRole);

                    return;
                }
            }
        );
    }
}
