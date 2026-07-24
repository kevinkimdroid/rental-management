@props(['color' => 'slate'])

@php
$colors = [
    'slate' => 'bg-zinc-100 text-zinc-700',
    'green' => 'bg-emerald-50 text-emerald-700',
    'yellow' => 'bg-amber-50 text-amber-700',
    'red' => 'bg-rose-50 text-rose-700',
    'blue' => 'bg-sky-50 text-sky-700',
    'indigo' => 'bg-indigo-50 text-indigo-700',
];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-md px-2.5 py-1 text-sm font-medium capitalize '.($colors[$color] ?? $colors['slate'])]) }}>
    {{ $slot }}
</span>
