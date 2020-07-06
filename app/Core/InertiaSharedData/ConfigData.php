<?php

namespace App\Core\InertiaSharedData;

/**
 * Class ConfigData
 * @package App\Core\InertiaSharedData
 */
class ConfigData implements DataSharableInterface
{
    /**
     * @inheritDoc
     */
    public function key(): string
    {
        return 'app';
    }

    /**
     * @inheritDoc
     */
    public function data()
    {
        return [
            'name'           => config('app.name'),
            'name_formatted' => $this->formatName(config('app.name')),
            'copyright_year' => $this->copyrightYears(),
            'main_url'       => config('config.main_url'),
            'support_url'    => config('config.support_url'),
            'developer'      => config('config.developer'),
        ];
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected function formatName(string $name): string
    {
        $splitted = explode('.', $name, 2);

        return sprintf("%s%s", $splitted[0], sprintf("<span class=\"text-primary\">.%s</span>", $splitted[1] ?? ""));
    }

    /**
     * @return string
     */
    protected function copyrightYears(): string
    {
        $startYear   = config('config.copyright.started_year');
        $currentYear = date('Y');

        return $currentYear > $startYear ? sprintf("%s - %s", $startYear, $currentYear) : sprintf("%s", $startYear);
    }
}
