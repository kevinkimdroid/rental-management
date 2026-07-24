<x-app-layout>
    <div class="mx-auto max-w-7xl space-y-6">
        <x-detail-header
            :title="$lease->unit->property->name . ' · Unit ' . $lease->unit->unit_number"
            :subtitle="$lease->tenant->full_name"
            :status="ucfirst($lease->status)"
            :statusColor="match($lease->status) { 'active' => 'green', 'expired' => 'slate', default => 'yellow' }"
        >
            <x-slot name="breadcrumb">
                <x-breadcrumb :items="[
                    ['label' => 'Leases', 'url' => route('leases.index')],
                    ['label' => $lease->unit->property->name . ' · Unit ' . $lease->unit->unit_number],
                ]" />
            </x-slot>
            <x-slot name="meta">
                <span>KES {{ number_format($lease->rent_amount, 0) }}/mo</span>
                <span>{{ $lease->start_date->format('M j, Y') }} — {{ $lease->end_date?->format('M j, Y') ?? 'Open-ended' }}</span>
            </x-slot>
            <x-slot name="actions">
                <x-btn :href="route('leases.edit', $lease)"><x-icon name="pencil" class="h-4 w-4" /> Edit</x-btn>
            </x-slot>
        </x-detail-header>

        <x-flash />

        <x-section-card title="Lease details">
            <dl class="detail-grid">
                <x-detail-field label="Tenant">
                    <a href="{{ route('tenants.show', $lease->tenant) }}" class="link-brand">{{ $lease->tenant->full_name }}</a>
                </x-detail-field>
                <x-detail-field label="Unit">
                    <a href="{{ route('units.show', $lease->unit) }}" class="link-brand">{{ $lease->unit->property->name }} · Unit {{ $lease->unit->unit_number }}</a>
                </x-detail-field>
                <x-detail-field label="Start date" :value="$lease->start_date->format('M j, Y')" />
                <x-detail-field label="End date" :value="$lease->end_date?->format('M j, Y') ?? '—'" />
                <x-detail-field label="Monthly rent" :value="'KES ' . number_format($lease->rent_amount, 0)" />
                <x-detail-field label="Deposit" :value="'KES ' . number_format($lease->deposit_amount, 0)" />
                <x-detail-field label="Status">
                    <x-badge :color="match($lease->status) { 'active' => 'green', 'expired' => 'slate', default => 'yellow' }">{{ $lease->status }}</x-badge>
                </x-detail-field>
            </dl>
        </x-section-card>

        <div class="surface overflow-hidden">
            <div class="surface-header">
                <h2 class="text-sm font-semibold text-zinc-900">Payments</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="table-shell min-w-full">
                    <thead><tr><th>Due date</th><th>Amount</th><th>Status</th></tr></thead>
                    <tbody>
                        @forelse ($lease->payments as $payment)
                            <tr>
                                <td><a href="{{ route('payments.show', $payment) }}" class="font-medium text-zinc-900 hover:text-brand-700">{{ $payment->due_date->format('M j, Y') }}</a></td>
                                <td class="font-medium tabular-nums">KES {{ number_format($payment->amount, 0) }}</td>
                                <td><x-badge :color="match($payment->status) { 'paid' => 'green', 'overdue' => 'red', default => 'yellow' }">{{ $payment->status }}</x-badge></td>
                            </tr>
                        @empty
                            <tr><td colspan="3"><x-empty-state icon="banknotes" title="No payments recorded" /></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
