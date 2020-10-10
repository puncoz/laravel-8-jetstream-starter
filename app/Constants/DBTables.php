<?php

namespace App\Constants;

/**
 * Class DBTables
 * @package App\Constants
 */
final class DBTables
{
    // @todo keep session table name default until issue with jetstream fixed
    public const SYS_SESSIONS      = 'sessions';
    public const SYS_MIGRATIONS    = 'sys_migrations';
    public const SYS_FAILED_JOBS   = 'sys_failed_jobs';
    public const SYS_ACTIVITY_LOGS = 'sys_activity_logs';

    public const AUTH_USERS                  = 'auth_users';
    public const AUTH_ROLES                  = 'auth_roles';
    public const AUTH_PERMISSIONS            = 'auth_permissions';
    public const AUTH_USERS_PERMISSIONS      = 'auth_users_permissions';
    public const AUTH_USERS_ROLES            = 'auth_users_roles';
    public const AUTH_ROLES_PERMISSIONS      = 'auth_roles_permissions';
    public const AUTH_PASSWORD_RESETS        = 'auth_password_resets';
    public const AUTH_PERSONAL_ACCESS_TOKENS = 'auth_personal_access_tokens';
    public const AUTH_TEAMS                  = 'auth_teams';
    public const AUTH_TEAMS_USERS            = 'auth_teams_users';
    public const AUTH_TEAMS_MEMBERSHIP       = 'auth_teams_membership';
}
