<?php

namespace App\Core\InertiaSharedData;

use App\Constants\General;

/**
 * Class StaticData
 * @package App\Core\InertiaSharedData
 */
class StaticData implements DataSharableInterface
{
    /**
     * @inheritDoc
     */
    public function key(): string
    {
        return 'staticData';
    }

    /**
     * @inheritDoc
     */
    public function data()
    {
        return [
            'paginate_sizes'        => General::PAGINATE_OPTIONS(),
            'paginate_default_size' => General::PAGINATE_DEFAULT(),
        ];
    }
}
