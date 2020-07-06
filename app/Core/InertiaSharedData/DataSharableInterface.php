<?php

namespace App\Core\InertiaSharedData;

/**
 * Interface DataSharableInterface
 * @package App\Core\InertiaSharedData
 */
interface DataSharableInterface
{
    /**
     * @return string
     */
    public function key(): string;

    /**
     * @return mixed
     */
    public function data();
}
