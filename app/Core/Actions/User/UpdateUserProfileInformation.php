<?php

namespace App\Core\Actions\User;

use App\Constants\DBTables;
use App\Data\Models\Entities\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

/**
 * Class UpdateUserProfileInformation
 * @package App\Core\Actions\User
 */
class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param User  $user
     * @param array $input
     *
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make(
            $input,
            [
                'name'     => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', Rule::unique(DBTables::AUTH_USERS)->ignore($user->id),],
                'email'    => ['required', 'email', 'max:255', Rule::unique(DBTables::AUTH_USERS)->ignore($user->id),],
                'photo'    => ['nullable', 'image', 'max:1024'],
            ]
        )->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ( $input['email'] !== $user->email && $user instanceof MustVerifyEmail ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill(
                [
                    'name'     => $input['name'],
                    'email'    => $input['email'],
                    'username' => $input['username'],
                ]
            )->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param User  $user
     * @param array $input
     *
     * @return void
     */
    protected function updateVerifiedUser(User $user, array $input)
    {
        $user->forceFill(
            [
                'name'              => $input['name'],
                'email'             => $input['email'],
                'email_verified_at' => null,
            ]
        )->save();

        $user->sendEmailVerificationNotification();
    }
}
