<?php

namespace App\Domain\Api\Transformers\Media;

use App\Data\Entities\Media\Media;
use League\Fractal\TransformerAbstract;

/**
 * Class MediaTransformer
 * @package App\Domain\Api\Transformers\Media
 */
class MediaTransformer extends TransformerAbstract
{
    public function transform(Media $media): array
    {
        return [
            'file_name' => $media->file_name,
            'url'       => $media->url,
        ];
    }
}
