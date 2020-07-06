<?php

use App\Constants\UserRoles;

return [
    'roles' => [
        'super_admin' => UserRoles::SUPER_ADMIN,
        'developer'   => UserRoles::DEVELOPER,
        'company'     => UserRoles::COMPANY,
    ],

    'permissions' => [
        'view_users'   => 'View Users',
        'add_users'    => 'Add Users',
        'edit_users'   => 'Edit Users',
        'delete_users' => 'Delete Users',
    ],

    'roles_permissions' => [
        UserRoles::DEVELOPER => '',
        UserRoles::COMPANY   => '',
    ],
];
