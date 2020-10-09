<?php

namespace App\Domain\Admin\Transformers\User;

use App\Data\Models\Entities\User;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer
 * @package App\Domain\Admin\Transformers\User
 */
class UserTransformer extends TransformerAbstract
{
    /**
     * @var string[]
     */
    protected $defaultIncludes = ['role'];

    /**
     * @param User $user
     *
     * @return array
     */
    public function transform(User $user): array
    {
        return [
            'id'              => $user->id,
            'name'            => $user->name,
            'email'           => $user->email,
            'display_name'    => $user->display_name,
            'profile_picture' => [
                'path' => $user->profile_photo_path,
                'url'  => $user->profile_photo_url,
            ],
            'created_at'      => dateResponse($user->created_at),
        ];
    }

    /**
     * @param User $user
     *
     * @return Item
     */
    public function includeRole(User $user): Item
    {
        return $this->item($user->primary_role, new RoleTransformer());
    }
}
