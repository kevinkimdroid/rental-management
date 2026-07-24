<?php

namespace Database\Factories;

use App\Models\Lease;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['paid', 'paid', 'pending', 'overdue']);

        return [
            'lease_id' => Lease::factory(),
            'amount' => $this->faker->numberBetween(8000, 60000),
            'due_date' => $this->faker->dateTimeBetween('-2 months', '+1 month'),
            'paid_date' => $status === 'paid' ? $this->faker->dateTimeBetween('-2 months', 'now') : null,
            'method' => $this->faker->randomElement(['cash', 'bank_transfer', 'mpesa', 'card']),
            'reference_number' => strtoupper($this->faker->bothify('REF-####??')),
            'status' => $status,
        ];
    }
}
