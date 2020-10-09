<?php

namespace Database\Seeders\Fakers;

use App\Constants\AuthRolesPermissions;
use App\Data\Models\Entities\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

/**
 * Class UserFaker
 * @package Database\Seeders
 */
class UserFaker extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = AuthRolesPermissions::ROLES();
        $roles = array_except_by_value($roles, AuthRolesPermissions::ROLE_ADMIN);

        User::factory()->count(rand(10, 25))->create()->each(
            function (User $user) use ($roles) {
                $user->assignRole(Arr::random($roles));
            }
        );
    }
}
