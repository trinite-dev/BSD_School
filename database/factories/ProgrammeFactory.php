<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Programme>
 */
class ProgrammeFactory extends Factory
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
            'classroom_id' =>  $this->faker->numberBetween($min = 1, $max = 5),
            'hour' => $this->faker->time,
            'day' => $this->faker->dayOfWeek($max = 'now'),
        ];
    }
}
