@props([
    'href' => null,
    'height' => 40,
])

<a href="{{ $href ?? url('/') }}" {{ $attributes->merge(['class' => 'brand-logo']) }}>
    <img
        src="{{ asset('images/logo.png') }}"
        alt="{{ config('app.name') }}"
        class="brand-logo-img"
        height="{{ $height }}"
        loading="eager"
    >
</a>
