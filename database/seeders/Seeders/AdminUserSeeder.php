<?php

namespace Database\Seeders\Seeders;

use App\Constants\AuthRolesPermissions;
use App\Data\Models\Entities\User;
use App\Data\Repositories\Team\TeamRepository;
use App\Data\Repositories\User\UserRepository;
use Illuminate\Database\Seeder;

/**
 * Class AdminUserSeeder
 * @package Database\Seeders\Seeders
 */
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param UserRepository $userRepository
     * @param TeamRepository $teamRepository
     *
     * @return void
     */
    public function run(UserRepository $userRepository, TeamRepository $teamRepository)
    {
        $users = $userRepository->byRole(AuthRolesPermissions::ROLE_ADMIN)->count();

        if ( $users === 0 ) {
            User::factory()->admin()->create()->each(
                function (User $user) use ($teamRepository) {
                    $user->assignRole(AuthRolesPermissions::ROLE_ADMIN);

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
}
