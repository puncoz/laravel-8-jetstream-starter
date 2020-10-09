<?php

namespace App\Core\InertiaData;

use App\Core\Utils\DataArraySerializer;
use App\Domain\Admin\Transformers\User\UserTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;

/**
 * Class CurrentUser
 * @package App\Core\InertiaData
 */
class CurrentUser implements DataSharableInterface
{
    /**
     * @inheritDoc
     */
    public function data()
    {
        return function () {
            if ( !currentUser() ) {
                return null;
            }

            $authUser = new Item(currentUser(), new UserTransformer());

            return (new Manager())->setSerializer(new DataArraySerializer())->createData($authUser)->toArray();
        };
    }

    /**
     * @inheritDoc
     */
    public function key(): string
    {
        return 'auth.user';
    }
}
