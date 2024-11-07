<?php

namespace Database\Factories;

use App\Models\Situation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'situation_id' => Situation::all()->random()->id,
            'description' => fake()->text($maxNbChars = 200),
            'data_tak' => fake()->dateTime($max = 'now', $timezone = null),
        ];
    }
}
