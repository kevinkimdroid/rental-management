<?php

namespace Database\Seeders;

use App\Models\Lease;
use App\Models\MaintenanceRequest;
use App\Models\Payment;
use App\Models\Property;
use App\Models\Tenant;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $landlord = User::factory()->create([
            'name' => 'Demo Landlord',
            'email' => 'landlord@example.com',
        ]);

        $tenants = Tenant::factory(15)->create();

        Property::factory(4)
            ->for($landlord)
            ->has(
                Unit::factory()
                    ->count(4)
                    ->sequence(fn ($sequence) => ['unit_number' => 'Unit '.($sequence->index + 1)])
                    ->state(['status' => 'vacant'])
            )
            ->create()
            ->each(function (Property $property) use ($tenants) {
                $units = $property->units;

                foreach ($units->take(3) as $unit) {
                    $tenant = $tenants->random();

                    $lease = Lease::factory()->create([
                        'unit_id' => $unit->id,
                        'tenant_id' => $tenant->id,
                        'rent_amount' => $unit->rent_amount,
                        'deposit_amount' => $unit->rent_amount,
                        'status' => 'active',
                    ]);

                    $unit->update(['status' => 'occupied']);

                    Payment::factory(3)->create(['lease_id' => $lease->id]);
                }

                MaintenanceRequest::factory(2)->create([
                    'unit_id' => $units->random()->id,
                    'tenant_id' => $tenants->random()->id,
                ]);
            });
    }
}
