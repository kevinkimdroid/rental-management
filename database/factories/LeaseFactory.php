<?php

namespace Database\Factories;

use App\Models\Lease;
use App\Models\Tenant;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lease>
 */
class LeaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rent = $this->faker->numberBetween(8000, 60000);

        return [
            'unit_id' => Unit::factory(),
            'tenant_id' => Tenant::factory(),
            'start_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'end_date' => null,
            'rent_amount' => $rent,
            'deposit_amount' => $rent,
            'status' => 'active',
        ];
    }
}
