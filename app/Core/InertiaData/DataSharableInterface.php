<?php

namespace App\Core\InertiaData;

/**
 * Interface DataSharableInterface
 * @package App\Core\InertiaData
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
