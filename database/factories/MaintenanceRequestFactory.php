<?php

namespace Database\Factories;

use App\Models\MaintenanceRequest;
use App\Models\Tenant;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MaintenanceRequest>
 */
class MaintenanceRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'unit_id' => Unit::factory(),
            'tenant_id' => Tenant::factory(),
            'title' => $this->faker->randomElement([
                'Leaking faucet', 'Broken window', 'AC not cooling', 'Power outage in unit',
                'Blocked drainage', 'Broken door lock', 'Pest control needed',
            ]),
            'description' => $this->faker->sentence(),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'status' => $this->faker->randomElement(['open', 'in_progress', 'resolved']),
            'reported_at' => $this->faker->dateTimeBetween('-2 months', 'now'),
            'resolved_at' => null,
        ];
    }
}
