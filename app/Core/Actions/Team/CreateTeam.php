<?php

namespace App\Core\Actions\Team;

use App\Data\Models\Entities\Team;
use App\Data\Models\Entities\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\CreatesTeams;
use Laravel\Jetstream\Jetstream;

/**
 * Class CreateTeam
 * @package App\Core\Actions\Team
 */
class CreateTeam implements CreatesTeams
{
    /**
     * Validate and create a new team for the given user.
     *
     * @param User  $user
     * @param array $input
     *
     * @return Team
     * @throws AuthorizationException
     */
    public function create($user, array $input)
    {
        Gate::forUser($user)->authorize('create', Jetstream::newTeamModel());

        Validator::make(
            $input,
            [
                'name' => ['required', 'string', 'max:255'],
            ]
        )->validateWithBag('createTeam');

        return $user->ownedTeams()->create(
            [
                'name'          => $input['name'],
                'personal_team' => false,
            ]
        );
    }
}
