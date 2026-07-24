<x-app-layout>
    <div class="mx-auto max-w-7xl space-y-6">
        <x-detail-header
            :title="$property->name"
            :subtitle="$property->address_line.', '.$property->city"
            :status="ucfirst($property->type)"
            statusColor="slate"
        >
            <x-slot name="breadcrumb">
                <x-breadcrumb :items="[
                    ['label' => 'Properties', 'url' => route('properties.index')],
                    ['label' => $property->name],
                ]" />
            </x-slot>
            <x-slot name="meta">
                <span>{{ $property->units->count() }} {{ Str::plural('unit', $property->units->count()) }}</span>
                <span>{{ $property->units->where('status', 'occupied')->count() }} occupied</span>
            </x-slot>
            <x-slot name="actions">
                <x-btn variant="secondary" :href="route('units.create')"><x-icon name="plus" class="h-4 w-4" /> Add unit</x-btn>
                <x-btn :href="route('properties.edit', $property)"><x-icon name="pencil" class="h-4 w-4" /> Edit</x-btn>
            </x-slot>
        </x-detail-header>

        <x-flash />

        <x-section-card title="Property details">
            <dl class="detail-grid">
                <x-detail-field label="Address" :value="$property->address_line" />
                <x-detail-field label="City" :value="$property->city" />
                <x-detail-field label="Type" :value="ucfirst($property->type)" />
                @if ($property->description)
                    <div class="sm:col-span-2 lg:col-span-3">
                        <x-detail-field label="Description">{{ $property->description }}</x-detail-field>
                    </div>
                @endif
            </dl>
        </x-section-card>

        <div class="surface overflow-hidden">
            <div class="surface-header">
                <div>
                    <h2 class="text-sm font-semibold text-zinc-900">Units at this property</h2>
                    <p class="text-xs text-zinc-500">{{ $property->units->count() }} total</p>
                </div>
                <x-btn variant="secondary" size="sm" :href="route('units.create')">Add unit</x-btn>
            </div>
            <div class="overflow-x-auto">
                <table class="table-shell min-w-full">
                    <thead>
                        <tr>
                            <th>Unit</th>
                            <th>Rent (KES)</th>
                            <th>Bed / Bath</th>
                            <th>Status</th>
                            <th>Tenant</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($property->units as $unit)
                            <tr>
                                <td>
                                    <a href="{{ route('units.show', $unit) }}" class="font-medium text-zinc-900 hover:text-brand-700">Unit {{ $unit->unit_number }}</a>
                                </td>
                                <td class="font-medium tabular-nums">{{ number_format($unit->rent_amount, 0) }}</td>
                                <td class="tabular-nums">{{ $unit->bedrooms }} / {{ $unit->bathrooms }}</td>
                                <td><x-badge :color="match($unit->status) { 'occupied' => 'blue', 'maintenance' => 'yellow', default => 'green' }">{{ $unit->status }}</x-badge></td>
                                <td>{{ optional($unit->activeLease->first()?->tenant)->full_name ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5"><x-empty-state icon="squares" title="No units yet" description="Add units to this property to track occupancy and rent." /></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
