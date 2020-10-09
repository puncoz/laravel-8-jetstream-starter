<?php

namespace App\Constants;

/**
 * Class General
 * @package App\Constants
 */
final class General
{
    public const PAGINATE_XXS = 5;
    public const PAGINATE_XS  = 10;
    public const PAGINATE_SM  = 15;
    public const PAGINATE_MD  = 25;
    public const PAGINATE_LG  = 50;
    public const PAGINATE_XL  = 75;
    public const PAGINATE_XXL = 100;

    public const DATE_FORMAT = 'j F, Y';

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
