@props(['label', 'value' => null])

<div {{ $attributes }}>
    <dt class="text-xs font-semibold uppercase tracking-wider text-zinc-500">{{ $label }}</dt>
    <dd class="mt-2 text-base font-medium text-zinc-900">
        @if ($value !== null && $value !== '')
            {{ $value }}
        @else
            {{ $slot }}
        @endif
    </dd>
</div>
