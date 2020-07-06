<?php

namespace App\Domain\BackOffice\Controllers\Users;

use App\Constants\UserRoles;
use App\Core\BaseClasses\Controller\BackOfficeController;
use App\Data\Entities\User\User;
use App\Data\Repositories\User\Role\RoleRepository;
use App\Domain\BackOffice\Criterias\Users\UserRequestCriteria;
use App\Domain\BackOffice\Presenters\User\UserPresenter;
use App\Domain\BackOffice\Requests\User\UserStoreRequest;
use App\Domain\BackOffice\Requests\User\UserUpdateRequest;
use App\Domain\BackOffice\Services\Users\UsersService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class UsersController
 * @package App\Domain\BackOffice\Controllers\Users
 */
class UsersController extends BackOfficeController
{
    /**
     * @var UsersService
     */
    protected $usersService;
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * UsersController constructor.
     *
     * @param UsersService   $usersService
     * @param RoleRepository $roleRepository
     */
    public function __construct(UsersService $usersService, RoleRepository $roleRepository)
    {
        $this->usersService   = $usersService;
        $this->roleRepository = $roleRepository;
    }

    /**
     * @return Response|ResponseFactory
     * @throws BindingResolutionException
     * @throws RepositoryException
     */
    public function index()
    {
        $queries = request()->all();
        $users   = $this->usersService->withCriteria(UserRequestCriteria::class, $queries)
                                      ->withPresenter(UserPresenter::class)
                                      ->getPaginated(request()->input('per_page'));
        $queries = empty($queries) ? null : $queries;

        return inertia('users/UserList', compact('users', 'queries'));
    }

    /**
     * @return Response|ResponseFactory
     */
    public function create()
    {
        $roles = $this->roleRepository->allExcept(UserRoles::SUPER_ADMIN)->pluck('name', 'name');

        return inertia('users/UserCreate', compact('roles'));
    }

    /**
     * @param UserStoreRequest $userStoreRequest
     *
     * @return RedirectResponse
     */
    public function store(UserStoreRequest $userStoreRequest)
    {
        $userStoreRequest->set()->persist()->assignRole();

        return redirect()->route('back.users.index')->with('success', 'User added successfully.');
    }

    /**
     * @param User $user
     * @return Response|ResponseFactory
     */
    public function edit(User $user)
    {
        $user->load('roles');
        $roles = $this->roleRepository->allExcept(UserRoles::SUPER_ADMIN)->pluck('name', 'name');

        return inertia('users/UserEdit', compact('user', 'roles'));
    }

    /**
     * @param User              $user
     * @param UserUpdateRequest $updateRequest
     * @return RedirectResponse
     */
    public function update(User $user, UserUpdateRequest $updateRequest)
    {
        $updateRequest->setUser($user)
                      ->set()
                      ->persist()
                      ->assignRole();

        return redirect()->route('back.users.show', $user->id)->with('success', 'User updated successfully.');
    }

    /**
     * @param User $user
     * @return Response|ResponseFactory
     */
    public function show(User $user)
    {
        return inertia('users/UserView', compact('user'));
    }

    /**
     * @param User $user
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('back.users.index');

    }
}
