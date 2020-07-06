<?php

namespace App\Core\InertiaSharedData;

/**
 * Class FlashMessages
 * @package App\Core\InertiaSharedData
 */
class FlashMessages implements DataSharableInterface
{
    /**
     * @inheritDoc
     */
    public function key(): string
    {
        return 'flash';
    }

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
}
