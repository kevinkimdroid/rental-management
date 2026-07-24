<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->company().' Apartments',
            'address_line' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'type' => $this->faker->randomElement(['residential', 'commercial']),
            'description' => $this->faker->sentence(),
        ];
    }
}
