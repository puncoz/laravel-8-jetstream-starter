<?php
declare(strict_types=1);


namespace App\Domain\BackOffice\Requests\User;


use App\Constants\DBTable;
use App\Constants\UserRoles;
use App\Data\Entities\User\User;
use App\Data\Repositories\User\UserRepository;
use Arr;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserStoreRequest
 * @package App\Domain\BackOffice\Requests
 */
class UserUpdateRequest extends FormRequest
{
    /**
     * @var array
     */
    private $data;
    /**
     * @var User
     */
    private $user;
    /**
     * @var User|mixed
     */
    private $updateUser;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserUpdateRequest constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();

        $this->userRepository = $userRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasRole(UserRoles::SUPER_ADMIN);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'     => ['sometimes', 'string', 'email', 'max:150', sprintf('unique:%s,email,%s,email', DBTable::AUTH_USERS, $this->get('email'))],
            'role'      => ['sometimes', 'string', 'max:150', sprintf("exists:%s,%s", DBTable::AUTH_ROLES, 'name')],
            'username'  => [
                'sometimes',
                'string',
                'max:100',
                sprintf('unique:%s,username,%s,username', DBTable::AUTH_USERS, $this->get('username')),
            ],
            'full_name' => ['sometimes', 'string', 'max:150'],
            'password'  => ['sometimes', 'confirmed', 'nullable', 'min:6'],
        ];
    }

    /**
     * @return UserUpdateRequest
     */
    public function set()
    {
        $data = tap(
            $this->validated(),
            function ($data) {
                $this->data = $data;
            }
        );

        if ( Arr::has($data, 'full_name') ) {
            $this->data['full_name'] = parseFullName(Arr::get($data, 'full_name'));
        }

        if ( Arr::has($data, 'email') ) {
            $this->data['email'] = Arr::get($data, 'email');
        }
        if ( Arr::has($data, 'username') ) {
            $this->data['username'] = Arr::get($data, 'username');
        }
        if ( Arr::has($data, 'password') && !is_null(Arr::get($data, 'password')) ) {
            $this->data['password'] = Arr::get($data, 'password');
        }

        if ( Arr::has($data, 'role') ) {
            $this->data['role'] = Arr::get($data, 'role');
        }

        return $this;
    }

    /**
     * @return UserUpdateRequest
     */
    public function persist()
    {
        $this->userRepository->update($this->data, $this->updateUser->id);

        return $this;
    }

    /**
     * @return UserUpdateRequest
     */
    public function assignRole()
    {
        if ( Arr::has($this->data, 'role') ) {
            $this->updateUser->assignRole(Arr::get($this->data, 'role'));
        }

        return $this;
    }


    /**
     * @param User $user
     *
     * @return UserUpdateRequest
     */
    public function setUser(User $user)
    {
        $this->updateUser = $user;

        return $this;
    }
}
