<?php

namespace App\Data\Repositories;

use App\Data\Repositories\Team\TeamEloquentRepository;
use App\Data\Repositories\Team\TeamRepository;
use App\Data\Repositories\User\PermissionEloquentRepository;
use App\Data\Repositories\User\PermissionRepository;
use App\Data\Repositories\User\RoleEloquentRepository;
use App\Data\Repositories\User\RoleRepository;
use App\Data\Repositories\User\UserEloquentRepository;
use App\Data\Repositories\User\UserRepository;

/**
 * Trait RepositoryBindings
 * @package App\Data\Repositories
 */
trait RepositoryBindings
{
    /**
     * @var array
     */
    protected array $repositories = [
        UserRepository::class       => UserEloquentRepository::class,
        RoleRepository::class       => RoleEloquentRepository::class,
        PermissionRepository::class => PermissionEloquentRepository::class,
        TeamRepository::class       => TeamEloquentRepository::class,
    ];
}
