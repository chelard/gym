<?php

namespace Database\Factories;

use App\Enums\PlanType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'type' => $this->faker->randomElement(PlanType::getLabels()),
            'days_duration' => $this->faker->numberBetween(1, 30),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'freeze_days' => $this->faker->numberBetween(0, 10),

        ];
    }
}
