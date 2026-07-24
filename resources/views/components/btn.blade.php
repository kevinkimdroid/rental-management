@props(['href' => null, 'variant' => 'primary', 'size' => 'md'])

@php
$variants = [
    'primary' => 'btn-primary',
    'secondary' => 'btn-secondary',
    'danger' => 'inline-flex items-center justify-center gap-2 rounded-xl bg-rose-600 px-5 py-3 text-base font-semibold text-white shadow-sm transition-all hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2',
    'ghost' => 'inline-flex items-center justify-center gap-2 rounded-xl px-4 py-2.5 text-base font-medium text-zinc-600 transition hover:bg-zinc-100',
];
$sizes = ['sm' => 'px-3.5 py-2 text-sm', 'md' => ''];
$classes = ($variants[$variant] ?? $variants['primary']).' '.($sizes[$size] ?? '');
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button {{ $attributes->merge(['type' => 'button', 'class' => $classes]) }}>{{ $slot }}</button>
@endif
