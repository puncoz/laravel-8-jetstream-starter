<?php

namespace App\Core\InertiaSharedData;

/**
 * Trait RegisterDataSharableClasses
 * @package App\Core\InertiaSharedData
 */
trait RegisterDataSharableClasses
{
    /**
     * @var array
     */
    protected $dataSharingClasses = [
        ConfigData::class,
        CurrentUser::class,
        FlashMessages::class,
        StaticData::class,
    ];
}
