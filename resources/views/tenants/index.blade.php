<x-app-layout>
    <div class="mx-auto max-w-7xl space-y-6">
        <x-page-header :title="__('Tenants')" subtitle="Residents and leaseholders" :count="$tenants->total()">
            <x-slot name="actions"><x-btn :href="route('tenants.create')"><x-icon name="plus" class="h-4 w-4" /> Add tenant</x-btn></x-slot>
        </x-page-header>
        <x-flash />
        <div class="surface overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table-shell min-w-full">
                    <thead><tr><th>Tenant</th><th>Email</th><th>Phone</th><th class="text-right">Actions</th></tr></thead>
                    <tbody>
                        @forelse ($tenants as $tenant)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-violet-50 text-sm font-semibold text-violet-700 ring-1 ring-violet-100">{{ strtoupper(substr($tenant->full_name, 0, 1)) }}</span>
                                        <a href="{{ route('tenants.show', $tenant) }}" class="font-medium text-zinc-900 hover:text-brand-700">{{ $tenant->full_name }}</a>
                                    </div>
                                </td>
                                <td>{{ $tenant->email }}</td>
                                <td>{{ $tenant->phone ?: '—' }}</td>
                                <td class="text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('tenants.show', $tenant) }}" class="rounded-lg px-2.5 py-1.5 text-sm font-medium text-zinc-500 hover:bg-zinc-100">View</a>
                                        <a href="{{ route('tenants.edit', $tenant) }}" class="rounded-lg p-2 text-zinc-400 hover:bg-zinc-100 hover:text-brand-700"><x-icon name="pencil" class="h-4 w-4" /></a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4"><x-empty-state icon="users" title="No tenants" description="Add tenants to start assigning leases." /></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($tenants->hasPages())<div class="border-t border-zinc-100 px-6 py-4">{{ $tenants->links() }}</div>@endif
        </div>
    </div>
</x-app-layout>
