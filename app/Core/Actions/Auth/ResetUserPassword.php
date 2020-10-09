<?php

namespace App\Core\Actions\Auth;

use App\Core\Rules\PasswordValidationRules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

/**
 * Class ResetUserPassword
 * @package App\Core\Actions\Auth
 */
class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param mixed $user
     * @param array $input
     *
     * @return void
     * @throws ValidationException
     */
    public function reset($user, array $input)
    {
        Validator::make(
            $input,
            [
                'password' => $this->passwordRules(),
            ]
        )->validate();

        $user->forceFill(
            [
                'password' => Hash::make($input['password']),
            ]
        )->save();
    }
}
