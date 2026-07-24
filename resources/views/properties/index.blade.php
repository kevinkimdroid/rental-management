<x-app-layout>
    <div class="mx-auto max-w-7xl space-y-6">
        <x-page-header :title="__('Properties')" subtitle="Your rental portfolio" :count="$properties->total()">
            <x-slot name="actions">
                <x-btn :href="route('properties.create')"><x-icon name="plus" class="h-4 w-4" /> Add property</x-btn>
            </x-slot>
        </x-page-header>

        <x-flash />

        <div class="surface overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table-shell min-w-full">
                    <thead>
                        <tr>
                            <th>Property</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Units</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($properties as $property)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <span class="entity-row-icon"><x-icon name="building" class="h-5 w-5" /></span>
                                        <div>
                                            <a href="{{ route('properties.show', $property) }}" class="font-medium text-zinc-900 hover:text-brand-700">{{ $property->name }}</a>
                                            <p class="mt-0.5 text-sm text-zinc-400">{{ Str::limit($property->address_line, 45) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $property->city }}</td>
                                <td><x-badge color="slate">{{ ucfirst($property->type) }}</x-badge></td>
                                <td class="font-medium tabular-nums text-zinc-900">{{ $property->units_count }}</td>
                                <td class="text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('properties.show', $property) }}" class="rounded-lg px-2.5 py-1.5 text-sm font-medium text-zinc-500 hover:bg-zinc-100 hover:text-brand-700">View</a>
                                        <a href="{{ route('properties.edit', $property) }}" class="rounded-lg p-2 text-zinc-400 hover:bg-zinc-100 hover:text-brand-700" title="Edit"><x-icon name="pencil" class="h-4 w-4" /></a>
                                        <form action="{{ route('properties.destroy', $property) }}" method="POST" onsubmit="return confirm('Delete this property?');">@csrf @method('DELETE')<button type="submit" class="rounded-lg p-2 text-zinc-400 hover:bg-rose-50 hover:text-rose-600" title="Delete"><x-icon name="trash" class="h-4 w-4" /></button></form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5"><x-empty-state icon="building" title="No properties yet" description="Add your first property to begin building your portfolio." /></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($properties->hasPages())
                <div class="border-t border-zinc-100 px-6 py-4">{{ $properties->links() }}</div>
            @endif
        </div>
    </div>
</x-app-layout>
