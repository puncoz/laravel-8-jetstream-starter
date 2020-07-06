<?php

namespace App\Domain\BackOffice\Services\Users;

use App\Constants\General;
use App\Data\Repositories\User\UserRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Collection;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class UsersService
 * @package App\Domain\BackOffice\Services\Users
 */
class UsersService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UsersService constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param int|null $perPage
     *
     * @return Collection|array
     */
    public function getPaginated(?int $perPage)
    {
        return $this->userRepository->paginate($perPage ?? General::PAGINATE_DEFAULT());
    }

    /**
     * @param $presenter
     *
     * @return UsersService
     */
    public function withPresenter($presenter): UsersService
    {
        $this->userRepository->setPresenter($presenter);

        return $this;
    }

    /**
     * @param string $criteria
     *
     * @param array  $filters
     *
     * @return UsersService
     * @throws BindingResolutionException
     * @throws RepositoryException
     */
    public function withCriteria(string $criteria, array $filters): UsersService
    {
        $this->userRepository->pushCriteria(app()->make($criteria, ['filters' => $filters]));

        return $this;
    }
}
