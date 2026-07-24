@php
$groups = [
    'Overview' => [
        ['route' => 'dashboard', 'pattern' => 'dashboard', 'icon' => 'home', 'label' => 'Dashboard'],
    ],
    'Portfolio' => [
        ['route' => 'properties.index', 'pattern' => 'properties.*', 'icon' => 'building', 'label' => 'Properties'],
        ['route' => 'units.index', 'pattern' => 'units.*', 'icon' => 'squares', 'label' => 'Units'],
        ['route' => 'tenants.index', 'pattern' => 'tenants.*', 'icon' => 'users', 'label' => 'Tenants'],
        ['route' => 'leases.index', 'pattern' => 'leases.*', 'icon' => 'document', 'label' => 'Leases'],
    ],
    'Finance & ops' => [
        ['route' => 'payments.index', 'pattern' => 'payments.*', 'icon' => 'banknotes', 'label' => 'Payments'],
        ['route' => 'maintenance-requests.index', 'pattern' => 'maintenance-requests.*', 'icon' => 'wrench', 'label' => 'Maintenance'],
    ],
];
@endphp

<aside class="sidebar fixed inset-y-0 left-0 z-50 flex w-[19rem] flex-col transition-transform duration-300 lg:translate-x-0" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
    <div class="sidebar-brand">
        @include('partials.brand-logo', ['href' => route('dashboard'), 'height' => 44])
        <button type="button" @click="sidebarOpen = false" class="sidebar-close lg:hidden" aria-label="Close menu">
            <x-icon name="x-mark" class="h-5 w-5" />
        </button>
    </div>

    <nav class="sidebar-nav flex-1 overflow-y-auto">
        @foreach ($groups as $group => $items)
            <p class="sidebar-group">{{ $group }}</p>
            <div class="mb-6 space-y-1">
                @foreach ($items as $item)
                    @php $active = request()->routeIs($item['pattern']); @endphp
                    <a href="{{ route($item['route']) }}" @click="sidebarOpen = false" @class(['sidebar-link', 'sidebar-link-active' => $active])>
                        <span class="sidebar-link-icon">
                            <x-icon :name="$item['icon']" class="h-5 w-5" />
                        </span>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>
        @endforeach
    </nav>

    <div class="sidebar-footer">
        <a href="{{ route('profile.edit') }}" class="sidebar-user">
            <span class="sidebar-user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
            <div class="min-w-0 flex-1">
                <p class="truncate text-base font-semibold text-white">{{ Auth::user()->name }}</p>
                <p class="truncate text-sm text-zinc-400">Account settings</p>
            </div>
            <x-icon name="chevron-down" class="h-4 w-4 shrink-0 -rotate-90 text-zinc-500" />
        </a>
    </div>
</aside>
