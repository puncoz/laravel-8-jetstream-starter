<?php

namespace App\Core\InertiaSharedData;

use App\Core\Utilities\DataArraySerializer;
use App\Domain\BackOffice\Transformers\User\AuthUserTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;

/**
 * Class CurrentUser
 * @package App\Core\InertiaSharedData
 */
class CurrentUser implements DataSharableInterface
{
    /**
     * @inheritDoc
     */
    public function key(): string
    {
        return 'auth.user';
    }

    /**
     * @inheritDoc
     */
    public function data()
    {
        return function () {
            $authUser = new Item(currentUser(), new AuthUserTransformer());

            return (new Manager())->setSerializer(new DataArraySerializer())->createData($authUser)->toArray();
        };
    }
}
