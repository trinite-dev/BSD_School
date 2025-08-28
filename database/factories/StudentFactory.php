<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'coderfid' => $this->faker->isbn13,  
            'users_id' =>  $this->faker->numberBetween($min = 1, $max = 9),  
            'classroom_id' =>  $this->faker->numberBetween($min = 1, $max = 5),
            //'classroom_group_id' =>  $this->faker->numberBetween($min = 1, $max = 5),    
        ];
    }
}
