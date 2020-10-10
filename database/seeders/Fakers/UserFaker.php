<?php

namespace Database\Seeders\Fakers;

use App\Constants\AuthRolesPermissions;
use App\Data\Models\Entities\User;
use App\Data\Repositories\Team\TeamRepository;
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
     * @param TeamRepository $teamRepository
     *
     * @return void
     */
    public function run(TeamRepository $teamRepository)
    {
        $roles = AuthRolesPermissions::ROLES();
        $roles = array_except_by_value($roles, AuthRolesPermissions::ROLE_ADMIN);

        User::factory()->count(rand(10, 25))->create()->each(
            function (User $user) use ($roles, $teamRepository) {
                $user->assignRole(Arr::random($roles));

                $teamRepository->create(
                    [
                        'user_id'       => $user->id,
                        'name'          => explode(' ', $user->name, 2)[0]."'s Team",
                        'personal_team' => true,
                    ]
                );
            }
        );
    }
}
