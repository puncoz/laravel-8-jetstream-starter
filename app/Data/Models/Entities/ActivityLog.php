<?php

namespace App\Data\Models\Entities;

use App\Constants\DBTables;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;

/**
 * Class ActivityLog
 * @package App\Data\Models\Entities
 *
 * @property int    $id
 * @property string $log_name
 * @property string $description
 * @property string $subject_type
 * @property int    $subject_id
 * @property string $causer_type
 * @property int    $causer_id
 * @property object $properties
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ActivityLog extends Activity
{
    protected $table = DBTables::SYS_ACTIVITY_LOGS;
}
