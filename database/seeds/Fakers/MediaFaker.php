<?php

use App\Data\Entities\Media\Media;
use Illuminate\Database\Seeder;

/**
 * Class MediaFaker
 */
class MediaFaker extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Media::class, rand(20, 50))->create();
    }
}
