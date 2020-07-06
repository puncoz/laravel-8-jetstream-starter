<?php

namespace App\Constants;

/**
 * Class General
 * @package App\Constants
 */
class General
{
    public const PAGINATE_XXS = 5;
    public const PAGINATE_XS  = 10;
    public const PAGINATE_SM  = 15;
    public const PAGINATE_MD  = 20;
    public const PAGINATE_LG  = 30;
    public const PAGINATE_XL  = 40;
    public const PAGINATE_XXL = 50;

    public const FORMAT_DATE_VIEW    = 'F j, Y';
    public const MEDIA_FILE_PATH     = 'app/public/images/';
    public const MEDIA_FILE_URL      = 'images/%s';
    public const MEDIA_DEFAULT_IMAGE = 'medias/default-image-rectagular.jpg';
    public const NA                  = 'NA';

    /**
     * @return int
     * @noinspection PhpMethodNamingConventionInspection
     */
    public static function PAGINATE_DEFAULT(): int
    {
        return self::PAGINATE_SM;
    }

    /**
     * @return array
     * @noinspection PhpMethodNamingConventionInspection
     */
    public static function PAGINATE_OPTIONS(): array
    {
        try {
            $reflectionClass = new \ReflectionClass(__CLASS__);
        } catch (\ReflectionException $exception) {
            return [];
        }

        return collect($reflectionClass->getConstants())->filter(
            function ($val, $constants) {
                return \Str::startsWith($constants, 'PAGINATE_');
            }
        )->toArray();
    }
}
