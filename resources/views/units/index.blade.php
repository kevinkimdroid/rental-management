<x-app-layout>
    <div class="mx-auto max-w-7xl space-y-6">
        <x-page-header :title="__('Units')" subtitle="Rooms and spaces across your portfolio" :count="$units->total()">
            <x-slot name="actions"><x-btn :href="route('units.create')"><x-icon name="plus" class="h-4 w-4" /> Add unit</x-btn></x-slot>
        </x-page-header>
        <x-flash />
        <div class="surface overflow-hidden">
            <table class="table-shell min-w-full">
                <thead><tr><th>Unit</th><th>Property</th><th>Bed / Bath</th><th>Rent</th><th>Status</th><th class="text-right">Actions</th></tr></thead>
                <tbody>
                    @forelse ($units as $unit)
                        <tr>
                            <td><div class="flex items-center gap-3"><span class="entity-row-icon"><x-icon name="squares" class="h-5 w-5" /></span><a href="{{ route('units.show', $unit) }}" class="font-medium text-zinc-900 hover:text-brand-700">Unit {{ $unit->unit_number }}</a></div></td>
                            <td>{{ $unit->property->name }}</td>
                            <td class="tabular-nums">{{ $unit->bedrooms }}/{{ $unit->bathrooms }}</td>
                            <td class="font-medium tabular-nums">KES {{ number_format($unit->rent_amount, 0) }}</td>
                            <td><x-badge :color="match($unit->status) { 'occupied' => 'blue', 'maintenance' => 'yellow', default => 'green' }">{{ $unit->status }}</x-badge></td>
                            <td class="text-right"><a href="{{ route('units.show', $unit) }}" class="text-sm font-medium text-zinc-500 hover:text-brand-700">View</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><x-empty-state icon="squares" title="No units" /></td></tr>
                    @endforelse
                </tbody>
            </table>
            @if ($units->hasPages())<div class="border-t border-zinc-100 px-6 py-4">{{ $units->links() }}</div>@endif
        </div>
    </div>
</x-app-layout>
