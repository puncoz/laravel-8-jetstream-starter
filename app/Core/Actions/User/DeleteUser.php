<?php

namespace App\Core\Actions\User;

use App\Data\Models\Entities\User;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Contracts\DeletesTeams;
use Laravel\Jetstream\Contracts\DeletesUsers;

/**
 * Class DeleteUser
 * @package App\Core\Actions\User
 */
class DeleteUser implements DeletesUsers
{
    /**
     * The team deleter implementation.
     *
     * @var DeletesTeams
     */
    protected DeletesTeams $deletesTeams;

    /**
     * Create a new action instance.
     *
     * @param DeletesTeams $deletesTeams
     *
     * @return void
     */
    public function __construct(DeletesTeams $deletesTeams)
    {
        $this->deletesTeams = $deletesTeams;
    }

    /**
     * Delete the given user.
     *
     * @param User $user
     *
     * @return void
     */
    public function delete($user)
    {
        DB::transaction(
            function () use ($user) {
                $this->deleteTeams($user);

                $user->delete();
            }
        );
    }

    /**
     * Delete the teams and team associations attached to the user.
     *
     * @param User $user
     *
     * @return void
     */
    protected function deleteTeams($user)
    {
        $user->teams()->detach();

        $user->owned_teams->each(
            function ($team) {
                $this->deletesTeams->delete($team);
            }
        );
    }
}
