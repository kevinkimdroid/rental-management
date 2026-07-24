@props(['padding' => 'p-6'])

<div {{ $attributes->merge(['class' => 'surface '.$padding]) }}>
    {{ $slot }}
</div>
