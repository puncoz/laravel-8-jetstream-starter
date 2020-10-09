<?php

namespace App\Core\Rules;

use Laravel\Fortify\Rules\Password;

/**
 * Trait PasswordValidationRules
 * @package App\Core\Rules
 */
trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @param bool $confirmed
     *
     * @return array
     */
    protected function passwordRules(bool $confirmed = true)
    {
        $rules = ['required', 'string', new Password()];

        if ( $confirmed ) {
            $rules[] = 'confirmed';
        }

        return $rules;
    }
}
