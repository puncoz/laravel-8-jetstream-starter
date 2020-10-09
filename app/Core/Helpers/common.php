<?php

use App\Constants\DBTables;
use App\Constants\General;
use App\Constants\Queue;
use App\Core\Jobs\LogUserActivity;
use App\Data\Models\Entities\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

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

/**
 * @return Authenticatable|User|null
 */
function currentUser()
{
    return auth()->user();
}

/**
 * @param string   $description
 * @param int|null $causer
 * @param Model    $subject
 * @param array    $properties
 * @param string   $logName
 */
function logActivity(string $description, ?int $causer, $subject, array $properties = [], string $logName = ''): void
{
    dispatch(new LogUserActivity($description, $causer, $subject, $properties, $logName))->onQueue(Queue::LOG);
}

/**
 * @param Carbon|string $date
 *
 * @return array|null
 */
function dateResponse($date): ?array
{
    if ( !$date ) {
        return null;
    }

    $date = $date instanceof Carbon ? $date : Carbon::parse($date);

    return [
        'raw'       => $date->toDateTimeString(),
        'formatted' => $date->format(General::DATE_FORMAT),
        'diff'      => $date->diffForHumans(),
    ];
}

/**
 * @param Blueprint $table
 * @param bool      $hasMetadata
 * @param bool      $hasSoftDeletes
 *
 * @return Blueprint
 */
function commonMigration(Blueprint $table, bool $hasMetadata = true, bool $hasSoftDeletes = false): Blueprint
{
    if ( $hasMetadata ) {
        $table->jsonb('metadata')->nullable();
    }

    $table->timestamps();
    $table->foreignId('created_by')->nullable()->index()->constrained(DBTables::AUTH_USERS)->onDelete(
        'cascade'
    );
    $table->foreignId('updated_by')->nullable()->index()->constrained(DBTables::AUTH_USERS)->onDelete(
        'cascade'
    );

    if ( $hasSoftDeletes ) {
        $table->softDeletes();
        $table->foreignId('deleted_by')->nullable()->index()->constrained(DBTables::AUTH_USERS)->onDelete(
            'cascade'
        );
    }

    return $table;
}
