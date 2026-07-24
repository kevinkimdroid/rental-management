<x-app-layout>
    <div class="mx-auto max-w-3xl space-y-6">
        <x-detail-header
            :title="'KES ' . number_format($payment->amount, 0)"
            :subtitle="$payment->lease->tenant->full_name"
            :status="ucfirst($payment->status)"
            :statusColor="match($payment->status) { 'paid' => 'green', 'overdue' => 'red', default => 'yellow' }"
        >
            <x-slot name="breadcrumb">
                <x-breadcrumb :items="[
                    ['label' => 'Payments', 'url' => route('payments.index')],
                    ['label' => 'Payment details'],
                ]" />
            </x-slot>
            <x-slot name="meta">
                <span>Due {{ $payment->due_date->format('M j, Y') }}</span>
                @if ($payment->paid_date)
                    <span>Paid {{ $payment->paid_date->format('M j, Y') }}</span>
                @endif
            </x-slot>
            <x-slot name="actions">
                <x-btn :href="route('payments.edit', $payment)"><x-icon name="pencil" class="h-4 w-4" /> Edit</x-btn>
            </x-slot>
        </x-detail-header>

        <x-flash />

        <x-section-card title="Payment details">
            <dl class="detail-grid">
                <x-detail-field label="Tenant">
                    <a href="{{ route('tenants.show', $payment->lease->tenant) }}" class="link-brand">{{ $payment->lease->tenant->full_name }}</a>
                </x-detail-field>
                <x-detail-field label="Unit">
                    <a href="{{ route('units.show', $payment->lease->unit) }}" class="link-brand">{{ $payment->lease->unit->property->name }} · Unit {{ $payment->lease->unit->unit_number }}</a>
                </x-detail-field>
                <x-detail-field label="Amount" :value="'KES ' . number_format($payment->amount, 0)" />
                <x-detail-field label="Due date" :value="$payment->due_date->format('M j, Y')" />
                <x-detail-field label="Paid date" :value="$payment->paid_date?->format('M j, Y') ?? '—'" />
                <x-detail-field label="Method" :value="ucfirst(str_replace('_', ' ', $payment->method ?? '—'))" />
                <x-detail-field label="Reference" :value="$payment->reference_number ?? '—'" />
                <x-detail-field label="Status">
                    <x-badge :color="match($payment->status) { 'paid' => 'green', 'overdue' => 'red', default => 'yellow' }">{{ $payment->status }}</x-badge>
                </x-detail-field>
            </dl>
        </x-section-card>
    </div>
</x-app-layout>
