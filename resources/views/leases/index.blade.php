<x-app-layout>
    <div class="mx-auto max-w-7xl space-y-6">
        <x-page-header :title="__('Leases')" subtitle="Active and historical agreements" :count="$leases->total()">
            <x-slot name="actions"><x-btn :href="route('leases.create')"><x-icon name="plus" class="h-4 w-4" /> Add lease</x-btn></x-slot>
        </x-page-header>
        <x-flash />
        <div class="surface overflow-hidden">
            <table class="table-shell min-w-full">
                <thead><tr><th>Lease</th><th>Tenant</th><th>Start</th><th>Rent</th><th>Status</th><th class="text-right">Actions</th></tr></thead>
                <tbody>
                    @forelse ($leases as $lease)
                        <tr>
                            <td><div class="flex items-center gap-3"><span class="entity-row-icon"><x-icon name="document" class="h-5 w-5" /></span><div><a href="{{ route('leases.show', $lease) }}" class="font-medium text-zinc-900 hover:text-brand-700">{{ $lease->unit->property->name }}</a><p class="text-sm text-zinc-400">Unit {{ $lease->unit->unit_number }}</p></div></div></td>
                            <td>{{ $lease->tenant->full_name }}</td>
                            <td class="tabular-nums">{{ $lease->start_date->format('M j, Y') }}</td>
                            <td class="font-medium tabular-nums">KES {{ number_format($lease->rent_amount, 0) }}</td>
                            <td><x-badge :color="match($lease->status) { 'active' => 'green', 'expired' => 'slate', default => 'yellow' }">{{ $lease->status }}</x-badge></td>
                            <td class="text-right"><a href="{{ route('leases.show', $lease) }}" class="text-sm font-medium text-zinc-500 hover:text-brand-700">View</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><x-empty-state icon="document" title="No leases" /></td></tr>
                    @endforelse
                </tbody>
            </table>
            @if ($leases->hasPages())<div class="border-t border-zinc-100 px-6 py-4">{{ $leases->links() }}</div>@endif
        </div>
    </div>
</x-app-layout>
