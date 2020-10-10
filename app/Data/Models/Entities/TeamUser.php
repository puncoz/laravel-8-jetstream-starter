<?php

namespace App\Data\Models\Entities;

use App\Constants\DBTables;
use Laravel\Jetstream\Membership as JetstreamMembership;

/**
 * Class TeamUser
 * @package App\Data\Models\Entities
 */
class TeamUser extends JetstreamMembership
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * @var string
     */
    protected $table = DBTables::AUTH_TEAMS_USERS;
}
