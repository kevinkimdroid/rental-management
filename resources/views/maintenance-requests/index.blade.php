<x-app-layout>
    <div class="mx-auto max-w-7xl space-y-6">
        <x-page-header :title="__('Maintenance')" subtitle="Repair requests and work orders" :count="$maintenanceRequests->total()">
            <x-slot name="actions"><x-btn :href="route('maintenance-requests.create')"><x-icon name="plus" class="h-4 w-4" /> Log request</x-btn></x-slot>
        </x-page-header>
        <x-flash />
        <div class="surface overflow-hidden">
            <table class="table-shell min-w-full">
                <thead><tr><th>Request</th><th>Location</th><th>Priority</th><th>Status</th><th>Reported</th><th class="text-right">Actions</th></tr></thead>
                <tbody>
                    @forelse ($maintenanceRequests as $request)
                        <tr>
                            <td><div class="flex items-center gap-3"><span class="entity-row-icon"><x-icon name="wrench" class="h-5 w-5" /></span><a href="{{ route('maintenance-requests.show', $request) }}" class="font-medium text-zinc-900 hover:text-brand-700">{{ $request->title }}</a></div></td>
                            <td class="text-sm">{{ $request->unit->property->name }} · {{ $request->unit->unit_number }}</td>
                            <td><x-badge :color="match($request->priority) { 'high' => 'red', 'medium' => 'yellow', default => 'slate' }">{{ $request->priority }}</x-badge></td>
                            <td><x-badge :color="match($request->status) { 'resolved' => 'green', 'in_progress' => 'blue', default => 'slate' }">{{ str_replace('_', ' ', $request->status) }}</x-badge></td>
                            <td class="tabular-nums text-sm">{{ $request->reported_at->format('M j, Y') }}</td>
                            <td class="text-right"><a href="{{ route('maintenance-requests.show', $request) }}" class="text-sm font-medium text-zinc-500 hover:text-brand-700">View</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><x-empty-state icon="wrench" title="No requests" /></td></tr>
                    @endforelse
                </tbody>
            </table>
            @if ($maintenanceRequests->hasPages())<div class="border-t border-zinc-100 px-6 py-4">{{ $maintenanceRequests->links() }}</div>@endif
        </div>
    </div>
</x-app-layout>
