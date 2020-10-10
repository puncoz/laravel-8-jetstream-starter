<?php

namespace App\Constants;

use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionException;

/**
 * Class AuthRolesPermissions
 * @package App\Constants
 */
final class AuthRolesPermissions
{
    public const ROLE_ADMIN      = 'admin';
    public const ROLE_DEVELOPERS = 'developers';

    /**
     * @return array
     * @noinspection PhpMethodNamingConventionInspection
     */
    public static function ROLES(): array
    {
        try {
            $reflectionClass = new ReflectionClass(__CLASS__);
        } catch (ReflectionException $exception) {
            return [];
        }

        return collect($reflectionClass->getConstants())->filter(
            function ($val, $constants) {
                return Str::startsWith($constants, 'ROLE_');
            }
        )->toArray();
    }

    /**
     * @return array
     * @noinspection PhpMethodNamingConventionInspection
     */
    public static function PERMISSIONS(): array
    {
        try {
            $reflectionClass = new ReflectionClass(__CLASS__);
        } catch (ReflectionException $exception) {
            return [];
        }

        return collect($reflectionClass->getConstants())->filter(
            function ($val, $constants) {
                return Str::startsWith($constants, 'PERMISSION_');
            }
        )->toArray();
    }
}
