<?php

use App\Data\Entities\Media\Media;
use App\Data\Entities\User\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */

$factory->define(
    Media::class,
    function (Faker $faker) {
        $users = User::all()->pluck('id');

        return [
            'file_name' => str_replace('lorempixel.com', 'picsum.photos', $faker->imageUrl()),
            'user_id'   => $users->random(),
        ];
    }
);
