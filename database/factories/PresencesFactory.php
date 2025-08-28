<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presences>
 */
class PresencesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'subjects_id' =>  $this->faker->numberBetween($min = 1, $max = 9),
            'users_id' =>  $this->faker->numberBetween($min = 1, $max = 9),
            'classroom_id' =>  $this->faker->numberBetween($min = 1, $max = 5),
            'startat' => $this->faker->dateTime($max = 'now', $timezone = null) ,
        ];
    }
}
