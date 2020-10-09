<?php

namespace App\Core\Actions\Auth;

use App\Constants\DBTables;
use App\Core\Rules\PasswordValidationRules;
use App\Data\Models\Entities\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

/**
 * Class CreateNewUser
 * @package App\Core\Actions\Auth
 */
class CreateNewUser implements CreatesNewUsers
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
                'email'    => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(DBTables::AUTH_USERS),
                ],
                'password' => $this->passwordRules(),
            ]
        )->validate();

        return User::create(
            [
                'name'     => $input['name'],
                'email'    => $input['email'],
                'password' => Hash::make($input['password']),
            ]
        );
    }
}
