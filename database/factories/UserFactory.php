<?php

namespace Database\Factories;

use App\Data\Models\Entities\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class UserFactory
 * @package Database\Factories
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'               => $this->faker->name,
            'email'              => $this->faker->unique()->safeEmail,
            'username'           => $this->faker->unique()->userName,
            'email_verified_at'  => $this->faker->boolean ? now() : null,
            'password'           => 'secret',
            'remember_token'     => $this->faker->boolean ? Str::random(10) : null,
            'profile_photo_path' => null,
        ];
    }

    /**
     * @return Factory
     */
    public function admin()
    {
        return $this->state(
            function (array $attributes) {
                return [
                    'name'              => 'Administrator',
                    'username'          => 'admin',
                    'email'             => 'admin@admin.com',
                    'email_verified_at' => now(),
                    'password'          => 'password',
                ];
            }
        );
    }
}
