<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classroom>
 */
class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'group_id' =>  $this->faker->numberBetween($min = 1, $max = 5),
            'kitbsd_id' =>  $this->faker->numberBetween($min = 1, $max = 5),
        ];
    }
}
