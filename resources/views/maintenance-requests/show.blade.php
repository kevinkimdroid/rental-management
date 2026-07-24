<x-app-layout>
    <div class="mx-auto max-w-3xl space-y-6">
        <x-detail-header
            :title="$maintenanceRequest->title"
            :subtitle="$maintenanceRequest->unit->property->name . ' · Unit ' . $maintenanceRequest->unit->unit_number"
            :status="ucfirst(str_replace('_', ' ', $maintenanceRequest->status))"
            :statusColor="match($maintenanceRequest->status) { 'resolved' => 'green', 'in_progress' => 'blue', default => 'slate' }"
        >
            <x-slot name="breadcrumb">
                <x-breadcrumb :items="[
                    ['label' => 'Maintenance', 'url' => route('maintenance-requests.index')],
                    ['label' => $maintenanceRequest->title],
                ]" />
            </x-slot>
            <x-slot name="meta">
                <span><x-badge :color="match($maintenanceRequest->priority) { 'high' => 'red', 'medium' => 'yellow', default => 'slate' }">{{ $maintenanceRequest->priority }} priority</x-badge></span>
                <span>Reported {{ $maintenanceRequest->reported_at->format('M j, Y') }}</span>
            </x-slot>
            <x-slot name="actions">
                <x-btn :href="route('maintenance-requests.edit', $maintenanceRequest)"><x-icon name="pencil" class="h-4 w-4" /> Edit</x-btn>
            </x-slot>
        </x-detail-header>

        <x-flash />

        <x-section-card title="Request details">
            <dl class="detail-grid">
                <x-detail-field label="Unit">
                    <a href="{{ route('units.show', $maintenanceRequest->unit) }}" class="link-brand">{{ $maintenanceRequest->unit->property->name }} · Unit {{ $maintenanceRequest->unit->unit_number }}</a>
                </x-detail-field>
                <x-detail-field label="Tenant" :value="$maintenanceRequest->tenant?->full_name ?? '—'" />
                <x-detail-field label="Priority">
                    <x-badge :color="match($maintenanceRequest->priority) { 'high' => 'red', 'medium' => 'yellow', default => 'slate' }">{{ $maintenanceRequest->priority }}</x-badge>
                </x-detail-field>
                <x-detail-field label="Status">
                    <x-badge :color="match($maintenanceRequest->status) { 'resolved' => 'green', 'in_progress' => 'blue', default => 'slate' }">{{ str_replace('_', ' ', $maintenanceRequest->status) }}</x-badge>
                </x-detail-field>
                <x-detail-field label="Reported" :value="$maintenanceRequest->reported_at->format('M j, Y')" />
                <x-detail-field label="Resolved" :value="$maintenanceRequest->resolved_at?->format('M j, Y') ?? '—'" />
                @if ($maintenanceRequest->description)
                    <div class="sm:col-span-2 lg:col-span-3">
                        <x-detail-field label="Description">{{ $maintenanceRequest->description }}</x-detail-field>
                    </div>
                @endif
            </dl>
        </x-section-card>
    </div>
</x-app-layout>
