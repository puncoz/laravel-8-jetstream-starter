<?php

namespace App\Data\Repositories;

use App\Data\Repositories\BlogRepository\BlogEloquentRepository;
use App\Data\Repositories\BlogRepository\BlogRepository;
use App\Data\Repositories\Event\EventEloquentRepository;
use App\Data\Repositories\Event\EventRepository;
use App\Data\Repositories\Faq\FaqCategoryEloquentRepository;
use App\Data\Repositories\Faq\FaqCategoryRepository;
use App\Data\Repositories\Faq\FaqEloquentRepository;
use App\Data\Repositories\Faq\FaqRepository;
use App\Data\Repositories\Location\LocationEloquentRepository;
use App\Data\Repositories\Location\LocationRepository;
use App\Data\Repositories\Media\MediaEloquentRepository;
use App\Data\Repositories\Media\MediaRepository;
use App\Data\Repositories\Package\PackageEloquentRepository;
use App\Data\Repositories\Package\PackageRepository;
use App\Data\Repositories\PrivateOffice\PrivateOfficeEloquentRepository;
use App\Data\Repositories\PrivateOffice\PrivateOfficeRepository;
use App\Data\Repositories\User\Permission\PermissionEloquentRepository;
use App\Data\Repositories\User\Permission\PermissionRepository;
use App\Data\Repositories\User\Role\RoleEloquentRepository;
use App\Data\Repositories\User\Role\RoleRepository;
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
    protected $repositories = [
        PermissionRepository::class    => PermissionEloquentRepository::class,
        RoleRepository::class          => RoleEloquentRepository::class,
        UserRepository::class          => UserEloquentRepository::class,
        MediaRepository::class         => MediaEloquentRepository::class,
    ];
}
