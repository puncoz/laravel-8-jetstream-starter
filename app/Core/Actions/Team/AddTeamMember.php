<?php

namespace App\Core\Actions\Team;

use App\Constants\DBTables;
use App\Data\Models\Entities\Team;
use App\Data\Models\Entities\User;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\AddsTeamMembers;
use Laravel\Jetstream\Events\TeamMemberAdded;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Rules\Role;

/**
 * Class AddTeamMember
 * @package App\Core\Actions\Team
 */
class AddTeamMember implements AddsTeamMembers
{
    /**
     * Add a new team member to the given team.
     *
     * @param User        $user
     * @param Team        $team
     * @param string      $email
     * @param string|null $role
     *
     * @return void
     * @throws AuthorizationException
     */
    public function add($user, $team, string $email, string $role = null)
    {
        Gate::forUser($user)->authorize('addTeamMember', $team);

        $this->validate($team, $email, $role);

        $team->users()->attach(
            $newTeamMember = Jetstream::findUserByEmailOrFail($email),
            ['role' => $role]
        );

        TeamMemberAdded::dispatch($team, $newTeamMember);
    }

    /**
     * Validate the add member operation.
     *
     * @param Team        $team
     * @param string      $email
     * @param string|null $role
     *
     * @return void
     */
    protected function validate($team, string $email, ?string $role)
    {
        Validator::make(
            [
                'email' => $email,
                'role'  => $role,
            ],
            $this->rules(),
            [
                'email.exists' => __('We were unable to find a registered user with this email address.'),
            ]
        )->after(
            $this->ensureUserIsNotAlreadyOnTeam($team, $email)
        )->validateWithBag('addTeamMember');
    }

    /**
     * Get the validation rules for adding a team member.
     *
     * @return array
     */
    protected function rules()
    {
        $usersTable = DBTables::AUTH_USERS;

        return array_filter(
            [
                'email' => ['required', 'email', "exists:{$usersTable}"],
                'role'  => Jetstream::hasRoles() ? ['required', 'string', new Role()] : null,
            ]
        );
    }

    /**
     * Ensure that the user is not already on the team.
     *
     * @param Team   $team
     * @param string $email
     *
     * @return Closure
     */
    protected function ensureUserIsNotAlreadyOnTeam($team, string $email)
    {
        return function ($validator) use ($team, $email) {
            $validator->errors()->addIf(
                $team->hasUserWithEmail($email),
                'email',
                __('This user already belongs to the team.')
            );
        };
    }
}
