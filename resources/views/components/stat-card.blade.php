@props(['label', 'value', 'icon', 'color' => 'brand', 'accent' => 'brand', 'hint' => null, 'href' => null])

@php
$iconStyles = [
    'brand' => 'bg-brand-50 text-brand-600',
    'emerald' => 'bg-emerald-50 text-emerald-600',
    'sky' => 'bg-sky-50 text-sky-600',
    'indigo' => 'bg-indigo-50 text-indigo-600',
    'amber' => 'bg-amber-50 text-amber-600',
    'rose' => 'bg-rose-50 text-rose-600',
];
$accentStyles = [
    'brand' => 'border-brand-500',
    'sky' => 'border-sky-500',
    'indigo' => 'border-indigo-500',
    'rose' => 'border-rose-500',
    'emerald' => 'border-emerald-500',
    'amber' => 'border-amber-500',
];
$tag = $href ? 'a' : 'div';
@endphp

<{{ $tag }}
    @if ($href) href="{{ $href }}" @endif
    {{ $attributes->merge(['class' => 'dash-stat group block border-t-4 '.($accentStyles[$accent] ?? $accentStyles['brand'])]) }}
>
    <div class="flex items-end justify-between gap-3">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-zinc-500">{{ $label }}</p>
            <p class="mt-1 text-3xl font-bold tabular-nums tracking-tight text-zinc-900 sm:text-4xl">{{ $value }}</p>
            @if ($hint)
                <p class="mt-1 text-sm text-zinc-400">{{ $hint }}</p>
            @endif
        </div>
        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl {{ $iconStyles[$color] ?? $iconStyles['brand'] }}">
            <x-icon :name="$icon" class="h-5 w-5" />
        </div>
    </div>
</{{ $tag }}>
