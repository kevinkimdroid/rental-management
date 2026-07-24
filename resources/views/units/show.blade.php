<x-app-layout>
    <div class="mx-auto max-w-7xl space-y-6">
        <x-detail-header
            :title="'Unit ' . $unit->unit_number"
            :subtitle="$unit->property->name . ' · ' . $unit->property->city"
            :status="ucfirst($unit->status)"
            :statusColor="match($unit->status) { 'occupied' => 'blue', 'maintenance' => 'yellow', default => 'green' }"
        >
            <x-slot name="breadcrumb">
                <x-breadcrumb :items="[
                    ['label' => 'Units', 'url' => route('units.index')],
                    ['label' => 'Unit ' . $unit->unit_number],
                ]" />
            </x-slot>
            <x-slot name="meta">
                <span>KES {{ number_format($unit->rent_amount, 0) }}/mo</span>
                <span>{{ $unit->bedrooms }} bed · {{ $unit->bathrooms }} bath</span>
            </x-slot>
            <x-slot name="actions">
                <x-btn :href="route('units.edit', $unit)"><x-icon name="pencil" class="h-4 w-4" /> Edit</x-btn>
            </x-slot>
        </x-detail-header>

        <x-flash />

        <x-section-card title="Unit details">
            <dl class="detail-grid">
                <x-detail-field label="Property">
                    <a href="{{ route('properties.show', $unit->property) }}" class="link-brand">{{ $unit->property->name }}</a>
                </x-detail-field>
                <x-detail-field label="Unit number" :value="$unit->unit_number" />
                <x-detail-field label="Monthly rent" :value="'KES ' . number_format($unit->rent_amount, 0)" />
                <x-detail-field label="Bedrooms / bathrooms" :value="$unit->bedrooms . ' / ' . $unit->bathrooms" />
                <x-detail-field label="Status">
                    <x-badge :color="match($unit->status) { 'occupied' => 'blue', 'maintenance' => 'yellow', default => 'green' }">{{ $unit->status }}</x-badge>
                </x-detail-field>
            </dl>
        </x-section-card>

        <div class="surface overflow-hidden">
            <div class="surface-header">
                <h2 class="text-sm font-semibold text-zinc-900">Lease history</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="table-shell min-w-full">
                    <thead><tr><th>Tenant</th><th>Start</th><th>End</th><th>Status</th></tr></thead>
                    <tbody>
                        @forelse ($unit->leases as $lease)
                            <tr>
                                <td><a href="{{ route('tenants.show', $lease->tenant) }}" class="font-medium text-zinc-900 hover:text-brand-700">{{ $lease->tenant->full_name }}</a></td>
                                <td class="tabular-nums">{{ $lease->start_date->format('M j, Y') }}</td>
                                <td class="tabular-nums">{{ $lease->end_date?->format('M j, Y') ?? '—' }}</td>
                                <td><x-badge :color="match($lease->status) { 'active' => 'green', 'expired' => 'slate', default => 'yellow' }">{{ $lease->status }}</x-badge></td>
                            </tr>
                        @empty
                            <tr><td colspan="4"><x-empty-state icon="document" title="No lease history" description="Leases for this unit will appear here." /></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="surface overflow-hidden">
            <div class="surface-header">
                <h2 class="text-sm font-semibold text-zinc-900">Maintenance requests</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="table-shell min-w-full">
                    <thead><tr><th>Issue</th><th>Priority</th><th>Status</th><th>Reported</th></tr></thead>
                    <tbody>
                        @forelse ($unit->maintenanceRequests as $request)
                            <tr>
                                <td><a href="{{ route('maintenance-requests.show', $request) }}" class="font-medium text-zinc-900 hover:text-brand-700">{{ $request->title }}</a></td>
                                <td><x-badge :color="match($request->priority) { 'high' => 'red', 'medium' => 'yellow', default => 'slate' }">{{ $request->priority }}</x-badge></td>
                                <td><x-badge :color="match($request->status) { 'resolved' => 'green', 'in_progress' => 'blue', default => 'slate' }">{{ str_replace('_', ' ', $request->status) }}</x-badge></td>
                                <td class="tabular-nums">{{ $request->reported_at->format('M j, Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4"><x-empty-state icon="wrench" title="No maintenance requests" /></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
