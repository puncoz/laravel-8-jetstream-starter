<?php

use App\Constants\DBTable;
use App\Constants\General;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\HtmlString;

if ( !function_exists('signed_route') ) {
    /**
     * Create a temporary signed route URL for a named route.
     *
     * @param string $name
     * @param Carbon $expiration
     * @param array  $parameters
     * @param bool   $absolute
     *
     * @return string
     * @noinspection PhpFunctionNamingConventionInspection
     */
    function signed_route(string $name, Carbon $expiration, array $parameters = [], bool $absolute = true)
    {
        return URL::temporarySignedRoute($name, $expiration, $parameters, $absolute);
    }
}

if ( !function_exists('time_now') ) {
    /**
     * @param string|null $timeZone
     *
     * @return Carbon
     * @noinspection PhpFunctionNamingConventionInspection
     */
    function time_now(?string $timeZone = null): Carbon
    {
        return Carbon::now($timeZone);
    }
}

if ( !function_exists('array_except_by_value') ) {
    /**
     * @param array  $array
     * @param string $value
     *
     * @return array
     * @noinspection PhpFunctionNamingConventionInspection
     */
    function array_except_by_value(array $array, string $value): array
    {
        unset($array[array_search($value, $array)]);

        return array_values($array);
    }
}

if ( !function_exists('getLocale') ) {
    /**
     * @return string
     */
    function getLocale(): string
    {
        return str_replace('_', '-', app()->getLocale());
    }
}

if ( !function_exists('front_mix') ) {
    /**
     * @param string $path
     *
     * @return HtmlString|string
     * @throws Exception
     * @noinspection PhpFunctionNamingConventionInspection
     */
    function front_mix(string $path)
    {
        return mix($path, 'assets/front-office');
    }
}

if ( !function_exists('back_mix') ) {
    /**
     * @param string $path
     *
     * @return HtmlString|string
     * @throws Exception
     * @noinspection PhpFunctionNamingConventionInspection
     */
    function back_mix(string $path)
    {
        return mix($path, 'assets/back-office');
    }
}

if ( !function_exists('auth_mix') ) {
    /**
     * @param string $path
     *
     * @return HtmlString|string
     * @throws Exception
     * @noinspection PhpFunctionNamingConventionInspection
     */
    function auth_mix(string $path)
    {
        return mix($path, 'assets/auth');
    }
}

if ( !function_exists('parseFullName') ) {

    /**
     * Parse name into array for json store
     *
     * @param string $fullName
     *
     * @return array
     */
    function parseFullName(string $fullName): array
    {
        /** @var array $explodedName */
        $explodedName = explode(' ', $fullName);

        $firstName  = array_shift($explodedName);
        $lastName   = array_pop($explodedName);
        $middleName = count($explodedName) ? trim(implode(' ', $explodedName)) : '';

        return [
            'first_name'  => $firstName,
            'middle_name' => $middleName,
            'last_name'   => $lastName,
        ];
    }
}

if ( !function_exists('isUrl') ) {
    /**
     * @param string $str
     *
     * @return bool
     */
    function isUrl(string $str): bool
    {
        return !!filter_var($str, FILTER_VALIDATE_URL);
    }
}

if ( !function_exists('commonMigrationColumns') ) {
    /**
     * @param Blueprint $table
     *
     * @return Blueprint
     */
    function commonMigrationColumns(Blueprint $table): Blueprint
    {
        $table->jsonb('metadata')->nullable();
        $table->integer('created_by')->unsigned()->index()->nullable();
        $table->integer('updated_by')->unsigned()->index()->nullable();
        $table->integer('deleted_by')->unsigned()->index()->nullable();
        $table->timestamps();
        $table->softDeletes();

        $table->foreign('created_by')->references('id')->on(DBTable::AUTH_USERS)->onDelete('cascade');
        $table->foreign('updated_by')->references('id')->on(DBTable::AUTH_USERS)->onDelete('cascade');
        $table->foreign('deleted_by')->references('id')->on(DBTable::AUTH_USERS)->onDelete('cascade');

        return $table;
    }
}

if ( !function_exists('dateResponse') ) {
    /**
     * @param Carbon $date
     *
     * @return array
     */
    function dateResponse(Carbon $date): array
    {
        return [
            'raw'       => $date->toDateTimeString(),
            'formatted' => $date->format(General::FORMAT_DATE_VIEW),
            'diff'      => $date->diffForHumans(),
        ];
    }
}
