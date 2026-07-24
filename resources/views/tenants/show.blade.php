<x-app-layout>
    <div class="mx-auto max-w-7xl space-y-6">
        <x-detail-header :title="$tenant->full_name" :subtitle="$tenant->email">
            <x-slot name="breadcrumb">
                <x-breadcrumb :items="[
                    ['label' => 'Tenants', 'url' => route('tenants.index')],
                    ['label' => $tenant->full_name],
                ]" />
            </x-slot>
            <x-slot name="actions">
                <x-btn :href="route('tenants.edit', $tenant)"><x-icon name="pencil" class="h-4 w-4" /> Edit</x-btn>
            </x-slot>
        </x-detail-header>

        <x-flash />

        <x-section-card title="Contact information">
            <dl class="detail-grid">
                <x-detail-field label="Full name" :value="$tenant->full_name" />
                <x-detail-field label="Email" :value="$tenant->email" />
                <x-detail-field label="Phone" :value="$tenant->phone ?: '—'" />
                <x-detail-field label="ID number" :value="$tenant->id_number ?: '—'" />
                <x-detail-field label="Emergency contact" :value="$tenant->emergency_contact ?: '—'" />
            </dl>
        </x-section-card>

        <div class="surface overflow-hidden">
            <div class="surface-header">
                <h2 class="text-sm font-semibold text-zinc-900">Lease history</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="table-shell min-w-full">
                    <thead><tr><th>Unit</th><th>Start date</th><th>Rent</th><th>Status</th></tr></thead>
                    <tbody>
                        @forelse ($tenant->leases as $lease)
                            <tr>
                                <td><a href="{{ route('leases.show', $lease) }}" class="font-medium text-zinc-900 hover:text-brand-700">{{ $lease->unit->property->name }} · Unit {{ $lease->unit->unit_number }}</a></td>
                                <td class="tabular-nums">{{ $lease->start_date->format('M j, Y') }}</td>
                                <td class="font-medium tabular-nums">KES {{ number_format($lease->rent_amount, 0) }}</td>
                                <td><x-badge :color="match($lease->status) { 'active' => 'green', 'expired' => 'slate', default => 'yellow' }">{{ $lease->status }}</x-badge></td>
                            </tr>
                        @empty
                            <tr><td colspan="4"><x-empty-state icon="document" title="No leases" description="This tenant has no lease records." /></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
