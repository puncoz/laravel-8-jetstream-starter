<?php
declare(strict_types=1);


namespace App\Domain\BackOffice\Controllers\Media;


use App\Constants\General;
use App\Core\BaseClasses\Controller\BackOfficeController;
use App\Data\Entities\Media\Media;
use App\Domain\BackOffice\Requests\Media\UploadStoreRequest;
use File;

/**
 * Class PhotoController
 * @package App\Domain\BackOffice\Controllers\Media
 */
class MediaController extends BackOfficeController
{
    /**
     * @param UploadStoreRequest $uploadStoreRequest
     * @return array
     */
    public function upload(UploadStoreRequest $uploadStoreRequest): array
    {
        /** @var Media $media */
        $media = $uploadStoreRequest->setUser($uploadStoreRequest->user())->set()->persist();

        return ['id' => $media->id];
    }

    /**
     * @param Media $media
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Media $media)
    {
        $imageName = $media->file_name;
        $path      = sprintf(storage_path(General::MEDIA_FILE_PATH), $imageName);

        if ( File::exists($path) ) {
            File::delete($path);
        }

        return $media->delete();
    }
}
