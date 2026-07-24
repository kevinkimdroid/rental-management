@props(['title', 'subtitle' => null, 'count' => null])

<div {{ $attributes }}>
    @isset($breadcrumb)
        {{ $breadcrumb }}
    @endisset
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <div class="flex items-center gap-3">
                <h1 class="page-title">{{ $title }}</h1>
                @if ($count !== null)
                    <span class="rounded-full bg-brand-50 px-3 py-1 text-sm font-semibold tabular-nums text-brand-700 ring-1 ring-brand-100">{{ $count }}</span>
                @endif
            </div>
            @if ($subtitle)
                <p class="page-subtitle">{{ $subtitle }}</p>
            @endif
        </div>
        @isset($actions)
            <div class="flex shrink-0 flex-wrap items-center gap-2">{{ $actions }}</div>
        @endisset
    </div>
</div>
