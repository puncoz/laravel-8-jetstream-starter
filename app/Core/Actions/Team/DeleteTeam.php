<?php

namespace App\Core\Actions\Team;

use App\Data\Models\Entities\Team;
use Laravel\Jetstream\Contracts\DeletesTeams;

/**
 * Class DeleteTeam
 * @package App\Core\Actions\Team
 */
class DeleteTeam implements DeletesTeams
{
    /**
     * Delete the given team.
     *
     * @param Team $team
     *
     * @return void
     */
    public function delete($team)
    {
        $team->purge();
    }
}
