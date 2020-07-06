<?php

namespace App\Data\Entities\Media;

use App\Constants\DBTable;
use App\Constants\General;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Media
 * @package App\Data\Entities\Media
 *
 * @property int    $id
 * @property string $file_name
 * @property int    $user_id
 * @property object $metadata
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property string $url
 */
class Media extends Model
{
    /**
     * @var string
     */
    protected $table = DBTable::CORE_MEDIAS;

    /**
     * @var string[]
     */
    protected $fillable = [
        'file_name',
        'user_id',
        'metadata',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'metadata' => 'object',
    ];

    public static function defaultImage(): string
    {
        return asset(General::MEDIA_DEFAULT_IMAGE);
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        if ( isUrl($this->file_name) ) {
            return $this->file_name;
        }

        $basePath     = General::MEDIA_FILE_PATH;
        $baseUrl      = General::MEDIA_FILE_URL;
        $defaultImage = General::MEDIA_DEFAULT_IMAGE;

        $file = storage_path("{$basePath}{$this->file_name}");

        if ( is_file($file) ) {
            return asset(sprintf($baseUrl, $this->file_name));
        }

        return asset($defaultImage);
    }
}
