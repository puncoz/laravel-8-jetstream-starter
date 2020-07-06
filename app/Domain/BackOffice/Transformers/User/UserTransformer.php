<?php

namespace App\Domain\BackOffice\Transformers\User;

use App\Constants\General;
use App\Data\Entities\User\User;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer
 * @package App\Domain\BackOffice\Transformers\User
 */
class UserTransformer extends TransformerAbstract
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
            'role'         => $user->primary_role->name,
            'created_at'   => [
                'raw'       => $user->created_at->toDateTimeString(),
                'formatted' => $user->created_at->format(General::FORMAT_DATE_VIEW),
                'diff'      => $user->created_at->diffForHumans(),
            ],
        ];
    }
}
