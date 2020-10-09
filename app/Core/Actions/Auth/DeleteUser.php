<?php

namespace App\Core\Actions\Auth;

use Laravel\Jetstream\Contracts\DeletesUsers;

/**
 * Class DeleteUser
 * @package App\Core\Actions\Auth
 */
class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param mixed $user
     *
     * @return void
     */
    public function delete($user)
    {
        $user->delete();
    }
}
