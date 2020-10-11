<?php

namespace App\Data\Models\Entities;

use App\Constants\DBTables;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * Class UserPersonalAccessToken
 * @package App\Data\Models\Entities
 */
class UserPersonalAccessToken extends PersonalAccessToken
{
    /**
     * @var string
     */
    protected $table = DBTables::AUTH_PERSONAL_ACCESS_TOKENS;
}
