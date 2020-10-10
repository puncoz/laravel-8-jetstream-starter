<?php

namespace App\Core\Actions\User;

use App\Constants\AuthRolesPermissions;
use App\Constants\DBTables;
use App\Core\Rules\PasswordValidationRules;
use App\Data\Models\Entities\Team;
use App\Data\Models\Entities\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

/**
 * Class RegisterUser
 * @package App\Core\Actions\User
 */
class RegisterUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     *
     * @return User
     * @throws ValidationException
     */
    public function create(array $input)
    {
        Validator::make(
            $input,
            [
                'name'     => ['required', 'string', 'max:255'],
                'email'    => ['required', 'string', 'email', 'max:255', Rule::unique(DBTables::AUTH_USERS)],
                'password' => $this->passwordRules(),
            ]
        )->validate();

        $username = $this->extractUsername($input);

        return DB::transaction(
            function () use ($input, $username) {
                return tap(
                    User::create(
                        [
                            'name'     => $input['name'],
                            'email'    => $input['email'],
                            'username' => $username,
                            'password' => $input['password'],
                        ]
                    ),
                    function (User $user) {
                        $this->createTeam($user);
                        $user->assignRole(AuthRolesPermissions::ROLE_DEVELOPERS);
                    }
                );
            }
        );
    }

    /**
     * Create a personal team for the user.
     *
     * @param User $user
     *
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(
            Team::forceCreate(
                [
                    'user_id'       => $user->id,
                    'name'          => explode(' ', $user->name, 2)[0]."'s Team",
                    'personal_team' => true,
                ]
            )
        );
    }

    /**
     * @param array $input
     *
     * @return string
     */
    protected function extractUsername(array $input): string
    {
        $email = $input['email'];

        [$username] = explode('@', $email);

        return $username;
    }
}
