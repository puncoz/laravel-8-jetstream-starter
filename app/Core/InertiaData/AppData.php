<?php

namespace App\Core\InertiaData;

/**
 * Class AppData
 * @package App\Core\InertiaData
 */
class AppData implements DataSharableInterface
{
    /**
     * @return array
     */
    public function data()
    {
        return [
            'name' => config('app.name'),
        ];
    }

    /**
     * @return string
     */
    public function key(): string
    {
        return 'app';
    }
}
