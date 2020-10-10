<?php

namespace Database\Factories;

use App\Data\Models\Entities\Team;
use App\Data\Models\Entities\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class TeamFactory
 * @package Database\Factories
 */
class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userId = User::all()->pluck('id')->toArray();

        return [
            'user_id'       => $this->faker->randomElement($userId),
            'name'          => explode(' ', $this->faker->name, 2)[0]."'s Team",
            'personal_team' => $this->faker->boolean,
        ];
    }
}
