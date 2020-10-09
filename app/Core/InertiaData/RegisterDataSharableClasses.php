<?php

namespace App\Core\InertiaData;

/**
 * Trait RegisterDataSharableClasses
 * @package App\Core\InertiaData
 */
trait RegisterDataSharableClasses
{
    /**
     * @var array
     */
    public array $dataSharingClasses = [
        AppData::class,
        CurrentUser::class,
        FlashMessages::class,
        StaticData::class,
    ];
}
