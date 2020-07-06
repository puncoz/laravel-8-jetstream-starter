<?php

namespace App\Domain\BackOffice\Transformers\User;

use App\Data\Entities\User\User;
use League\Fractal\TransformerAbstract;

/**
 * Class AuthUserTransformer
 * @package App\Domain\BackOffice\Transformers\User
 */
class AuthUserTransformer extends TransformerAbstract
{
    /**
     * @param User $user
     *
     * @return array
     */
    public function transform(User $user): array
    {
        return [
            'id'           => $user->id,
            'display_name' => $user->display_name,
            'initials'     => $user->initials,
            'username'     => $user->username,
            'email'        => $user->email,
        ];
    }
}
