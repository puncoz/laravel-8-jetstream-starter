<?php

namespace App\Core\Actions\Team;

use App\Data\Models\Entities\Team;
use App\Data\Models\Entities\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\UpdatesTeamNames;

/**
 * Class UpdateTeamName
 * @package App\Core\Actions\Team
 */
class UpdateTeamName implements UpdatesTeamNames
{
    /**
     * Validate and update the given team's name.
     *
     * @param User  $user
     * @param Team  $team
     * @param array $input
     *
     * @return void
     * @throws AuthorizationException
     */
    public function update($user, $team, array $input)
    {
        Gate::forUser($user)->authorize('update', $team);

        Validator::make(
            $input,
            [
                'name' => ['required', 'string', 'max:255'],
            ]
        )->validateWithBag('updateTeamName');

        $team->forceFill(
            [
                'name' => $input['name'],
            ]
        )->save();
    }
}
