<?php
declare(strict_types=1);


namespace App\Domain\BackOffice\Requests\Media;


use App\Constants\General;
use App\Data\Entities\User\User;
use Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UploadStoreRequest
 * @package App\Domain\BackOffice\Requests\Media
 */
class UploadStoreRequest extends FormRequest
{

    /**
     * @var array
     */
    protected $data;
    /**
     * @var User
     */
    protected $user;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg',
                'max:2048',
            ]
        ];
    }

    /**
     * @param User $user
     *
     * @return UploadStoreRequest
     */
    public function setUser(User $user): UploadStoreRequest
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return UploadStoreRequest
     */
    public function set(): UploadStoreRequest
    {
        $data = tap(
            $this->validated(),
            function ($data) {
                $this->data = $data;
            }
        );

        if ( Arr::has($data, 'file') ) {
            $file      = Arr::get($data, 'file');
            $imageName = sprintf('%s-%s', time(), $file->getClientOriginalName());
            $file->move(storage_path(General::MEDIA_FILE_PATH), $imageName);

            $this->data              = [];
            $this->data['file_name'] = $imageName;
        }

        return $this;
    }

    /**
     * @return Model
     */
    public function persist()
    {
        return $this->user->media()->create($this->data);
    }
}
