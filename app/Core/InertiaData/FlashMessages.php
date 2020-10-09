<?php

namespace App\Core\InertiaData;

/**
 * Class FlashMessages
 * @package App\Core\InertiaData
 */
class FlashMessages implements DataSharableInterface
{
    /**
     * @inheritDoc
     */
    public function data()
    {
        return function () {
            return [
                'message' => session()->get('message'),
                'success' => session()->get('success'),
                'error'   => session()->get('error'),
                'warning' => session()->get('warning'),
                'info'    => session()->get('info'),
            ];
        };
    }

    /**
     * @inheritDoc
     */
    public function key(): string
    {
        return 'flash';
    }
}
