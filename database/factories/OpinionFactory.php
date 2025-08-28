<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Opinion>
 */
class OpinionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['Mediocre', 'Passable', 'Bien', 'Excellent']),
            'student_id' =>  $this->faker->numberBetween($min = 1, $max = 25),
            'presences_id' =>  $this->faker->numberBetween($min = 1, $max = 225),

            /*'presences_classroom_id' =>  $this->faker->numberBetween($min = 1, $max = 5),
            'presences_users_id' =>  $this->faker->numberBetween($min = 1, $max = 9),
            'presences_subjects_id' =>  $this->faker->numberBetween($min = 1, $max = 9),*/
        ];
    }
}
