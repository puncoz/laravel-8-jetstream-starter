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
class UserStoreRequest extends FormRequest
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
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserStoreRequest constructor.
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
            'email'     => ['required', 'string', 'email', 'max:150', sprintf("unique:%s", DBTable::AUTH_USERS)],
            'role'      => ['required', 'string', 'max:150', sprintf("exists:%s,%s", DBTable::AUTH_ROLES, 'name')],
            'username'  => ['required', 'string', 'max:100', sprintf("unique:%s,%s", DBTable::AUTH_USERS, 'username')],
            'full_name' => ['required', 'string', 'max:150'],
            'password'  => ['required', 'confirmed', 'string', 'min:6'],
        ];
    }

    /**
     * @return UserStoreRequest
     */
    public function set()
    {
        $data = $this->validated();

        $this->data = [
            'email'     => Arr::get($data, 'email'),
            'username'  => Arr::get($data, 'username'),
            'full_name' => parseFullName(Arr::get($data, 'full_name')),
            'password'  => Arr::get($data, 'password'),
            'role'      => Arr::get($data, 'role'),
        ];

        return $this;
    }

    /**
     * @return UserStoreRequest
     */
    public function persist()
    {
        $this->user = $this->userRepository->create($this->data);

        return $this;
    }

    /**
     * @return UserStoreRequest
     */
    public function assignRole()
    {
        $this->user->assignRole(Arr::get($this->data, 'role'));

        return $this;
    }
}
