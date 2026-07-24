@props(['title', 'subtitle' => null, 'status' => null, 'statusColor' => 'green'])

<div {{ $attributes }}>
    @isset($breadcrumb)
        {{ $breadcrumb }}
    @endisset
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <div class="flex flex-wrap items-center gap-3">
                <h1 class="text-3xl font-semibold tracking-tight text-zinc-900">{{ $title }}</h1>
                @if ($status)
                    <x-badge :color="$statusColor">{{ $status }}</x-badge>
                @endif
            </div>
            @if ($subtitle)
                <p class="mt-2 text-base text-zinc-500">{{ $subtitle }}</p>
            @endif
            @isset($meta)
                <div class="mt-4 flex flex-wrap gap-4 text-base text-zinc-500">{{ $meta }}</div>
            @endisset
        </div>
        @isset($actions)
            <div class="flex shrink-0 flex-wrap items-center gap-2">{{ $actions }}</div>
        @endisset
    </div>
</div>
