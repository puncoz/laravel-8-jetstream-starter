<?php

namespace Database\Seeders\Seeders;

use App\Constants\AuthRolesPermissions;
use App\Data\Repositories\User\PermissionRepository;
use Illuminate\Database\Seeder;

/**
 * Class PermissionsSeeder
 * @package Database\Seeders\Seeders
 */
class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param PermissionRepository $permissionRepository
     *
     * @return void
     */
    public function run(PermissionRepository $permissionRepository)
    {
        app()['cache']->forget(config('permission.cache.key'));

        collect(AuthRolesPermissions::PERMISSIONS())->each(
            function (string $permissionName) use ($permissionRepository) {
                $permissionRepository->updateOrCreate(['name' => $permissionName]);
            }
        );
    }
}
