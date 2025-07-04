<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $type = fake()->randomElement(['Individual', 'Business']);
        $name = $type == 'Individual' ? fake()->name() : fake()->company();

        return [
            'name' => $name,
            'type' => $type,
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->address(),
        ];
    }
}
