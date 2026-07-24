<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-xl font-semibold text-zinc-900">Dashboard</h1>
            <p class="text-sm text-zinc-500">{{ now()->format('l, F j, Y') }}</p>
        </div>
    </x-slot>

    @php
        $occupancy = $unitCount > 0 ? round(($occupiedUnitCount / $unitCount) * 100) : 0;
        $hour = now()->hour;
        $greeting = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');
        $firstName = explode(' ', Auth::user()->name)[0];
        $isEmpty = $propertyCount === 0 && $unitCount === 0;
    @endphp

    <div class="dash mx-auto max-w-7xl space-y-6">
        {{-- Welcome strip --}}
        <div class="dash-welcome">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-lg font-semibold text-zinc-900">{{ $greeting }}, {{ $firstName }}</p>
                    <p class="mt-1 text-base text-zinc-500">
                        @if ($isEmpty)
                            Get started by adding your first property to the portfolio.
                        @else
                            Managing {{ $propertyCount }} {{ Str::plural('property', $propertyCount) }}, {{ $unitCount }} {{ Str::plural('unit', $unitCount) }}, and {{ $tenantCount }} {{ Str::plural('tenant', $tenantCount) }}.
                        @endif
                    </p>
                </div>
                <div class="flex shrink-0 flex-wrap gap-3">
                    <a href="{{ route('properties.create') }}" class="btn-primary">
                        <x-icon name="plus" class="h-5 w-5" /> Add property
                    </a>
                    <a href="{{ route('payments.create') }}" class="btn-secondary">
                        <x-icon name="banknotes" class="h-5 w-5" /> Record payment
                    </a>
                </div>
            </div>
        </div>

        @if ($isEmpty)
            <div class="dash-onboard">
                <div class="dash-onboard-icon">
                    <x-icon name="building" class="h-8 w-8" />
                </div>
                <div class="flex-1">
                    <h2 class="text-xl font-semibold text-zinc-900">Build your portfolio</h2>
                    <p class="mt-1 text-base text-zinc-500">Add a property, create units, and start tracking rent — it only takes a few minutes.</p>
                </div>
                <a href="{{ route('properties.create') }}" class="btn-primary shrink-0">Add your first property</a>
            </div>
        @endif

        {{-- Stats --}}
        <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
            <x-stat-card label="Properties" :value="$propertyCount" icon="building" color="brand" accent="brand" :href="route('properties.index')" />
            <x-stat-card label="Total units" :value="$unitCount" icon="squares" color="sky" accent="sky" :href="route('units.index')" />
            <x-stat-card label="Tenants" :value="$tenantCount" icon="users" color="indigo" accent="indigo" :href="route('tenants.index')" />
            <x-stat-card label="Open maintenance" :value="$openMaintenanceCount" icon="wrench" color="rose" accent="rose" :href="route('maintenance-requests.index')" />
        </div>

        {{-- Main panels --}}
        <div class="grid gap-5 lg:grid-cols-2">
            {{-- Occupancy --}}
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h2 class="dash-card-title">Occupancy</h2>
                        <p class="dash-card-sub">{{ $occupiedUnitCount }} of {{ $unitCount }} units filled</p>
                    </div>
                    <a href="{{ route('units.index') }}" class="dash-link">Units →</a>
                </div>
                <div class="dash-card-body">
                    <div class="flex items-center gap-8">
                        <div class="dash-ring" style="--pct: {{ $occupancy }}">
                            <div class="dash-ring-inner">
                                <span class="text-2xl font-bold tabular-nums text-zinc-900">{{ $occupancy }}%</span>
                            </div>
                        </div>
                        <div class="grid flex-1 gap-3">
                            <div class="dash-pill">
                                <span class="dash-pill-dot bg-brand-500"></span>
                                <span class="dash-pill-label">Occupied</span>
                                <span class="dash-pill-val">{{ $occupiedUnitCount }}</span>
                            </div>
                            <div class="dash-pill">
                                <span class="dash-pill-dot bg-zinc-300"></span>
                                <span class="dash-pill-label">Vacant</span>
                                <span class="dash-pill-val">{{ $vacantUnitCount }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6">
                        <div class="mb-2 flex justify-between text-sm font-medium text-zinc-600">
                            <span>Fill rate</span>
                            <span class="text-brand-700">{{ $occupancy }}%</span>
                        </div>
                        <div class="h-2.5 overflow-hidden rounded-full bg-zinc-100">
                            <div class="h-full rounded-full bg-brand-500 transition-all duration-500" style="width: {{ max($occupancy, $unitCount > 0 ? 2 : 0) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Finance --}}
            <div class="dash-card dash-card-accent">
                <div class="dash-card-head">
                    <div>
                        <h2 class="dash-card-title">Outstanding rent</h2>
                        <p class="dash-card-sub">Pending & overdue payments</p>
                    </div>
                    <a href="{{ route('payments.index') }}" class="dash-link">Payments →</a>
                </div>
                <div class="dash-card-body flex flex-col justify-between">
                    <p class="text-4xl font-bold tabular-nums tracking-tight text-zinc-900">
                        KES {{ number_format($rentDue, 0) }}
                    </p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('payments.create') }}" class="btn-primary">Record payment</a>
                        <a href="{{ route('payments.index') }}" class="btn-secondary">View all</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Activity --}}
        <div class="grid gap-5 lg:grid-cols-2">
            <div class="dash-card">
                <div class="dash-card-head">
                    <h2 class="dash-card-title">Recent payments</h2>
                    <a href="{{ route('payments.index') }}" class="dash-link">View all →</a>
                </div>
                <div class="dash-card-body !p-0">
                    @forelse ($recentPayments as $payment)
                        <a href="{{ route('payments.show', $payment) }}" class="dash-row group">
                            <span class="dash-avatar">{{ strtoupper(substr($payment->lease->tenant->full_name, 0, 1)) }}</span>
                            <div class="min-w-0 flex-1">
                                <p class="truncate font-semibold text-zinc-900 group-hover:text-brand-700">{{ $payment->lease->tenant->full_name }}</p>
                                <p class="text-sm text-zinc-500">Due {{ $payment->due_date->format('M j, Y') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold tabular-nums text-zinc-900">KES {{ number_format($payment->amount, 0) }}</p>
                                <x-badge :color="match($payment->status) { 'paid' => 'green', 'overdue' => 'red', default => 'yellow' }">{{ $payment->status }}</x-badge>
                            </div>
                        </a>
                    @empty
                        <div class="px-6 py-10 text-center">
                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-zinc-100 text-zinc-400">
                                <x-icon name="banknotes" class="h-7 w-7" />
                            </div>
                            <p class="mt-4 font-semibold text-zinc-800">No payments yet</p>
                            <p class="mt-1 text-base text-zinc-500">Record rent collections to see them here.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="dash-card">
                <div class="dash-card-head">
                    <h2 class="dash-card-title">Maintenance</h2>
                    <a href="{{ route('maintenance-requests.index') }}" class="dash-link">View all →</a>
                </div>
                <div class="dash-card-body !p-0">
                    @forelse ($recentMaintenanceRequests as $request)
                        <a href="{{ route('maintenance-requests.show', $request) }}" class="dash-row group">
                            <span class="dash-avatar dash-avatar-warn">{{ strtoupper(substr($request->title, 0, 1)) }}</span>
                            <div class="min-w-0 flex-1">
                                <p class="truncate font-semibold text-zinc-900 group-hover:text-brand-700">{{ $request->title }}</p>
                                <p class="truncate text-sm text-zinc-500">{{ $request->unit->property->name }} · Unit {{ $request->unit->unit_number }}</p>
                            </div>
                            <div class="flex shrink-0 flex-col items-end gap-1">
                                <x-badge :color="match($request->priority) { 'high' => 'red', 'medium' => 'yellow', default => 'slate' }">{{ $request->priority }}</x-badge>
                                <x-badge :color="match($request->status) { 'resolved' => 'green', 'in_progress' => 'blue', default => 'slate' }">{{ str_replace('_', ' ', $request->status) }}</x-badge>
                            </div>
                        </a>
                    @empty
                        <div class="px-6 py-10 text-center">
                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-zinc-100 text-zinc-400">
                                <x-icon name="wrench" class="h-7 w-7" />
                            </div>
                            <p class="mt-4 font-semibold text-zinc-800">All clear</p>
                            <p class="mt-1 text-base text-zinc-500">No maintenance requests at the moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
