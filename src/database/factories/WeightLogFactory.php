<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{
    public function definition(): array
    {
        return [
            'date' => $this->faker->dateTimeBetween('-60 days', 'now')->format('Y-m-d'),
            'weight' => $this->faker->randomFloat(1, 45, 70),
            'calories' => $this->faker->numberBetween(1000, 2500),
            'exercise_time' => $this->faker->time('H:i'),
            'exercise_content' => $this->faker->optional()->sentence,
        ];
    }
}
