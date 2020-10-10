<?php

namespace Database\Seeders;

use Database\Seeders\Fakers\UserFaker;
use Database\Seeders\Seeders\AdminUserSeeder;
use Database\Seeders\Seeders\PermissionsSeeder;
use Database\Seeders\Seeders\RolesSeeder;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 * @package Database\Seeders
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seeders
        $this->call(
            [
                PermissionsSeeder::class,
                RolesSeeder::class,
                AdminUserSeeder::class,
            ]
        );

        // Fakers
        if ( app()->environment() === 'production' ) {
            return;
        }

        $confirmation = $this->command->confirm(
            'Do you wish to run fakers? Fakers create dummy data for test purpose.'
        );
        if ( $confirmation ) {
            $this->call(
                [
                    UserFaker::class,
                ]
            );
        }
    }
}
