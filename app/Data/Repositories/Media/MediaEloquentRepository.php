<?php

namespace App\Data\Repositories\Media;

use App\Core\BaseClasses\Repository\Repository;
use App\Data\Entities\Media\Media;

/**
 * Class MediaEloquentRepository
 * @package App\Data\Repositories\Media
 */
class MediaEloquentRepository extends Repository implements MediaRepository
{

    /**
     * @return string
     */
    public function model()
    {
        return Media::class;
    }
}
