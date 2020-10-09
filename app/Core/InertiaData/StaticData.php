<?php

namespace App\Core\InertiaData;

use App\Constants\General;

/**
 * Class StaticData
 * @package App\Core\InertiaData
 */
class StaticData implements DataSharableInterface
{
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

    /**
     * @inheritDoc
     */
    public function key(): string
    {
        return 'staticData';
    }
}
