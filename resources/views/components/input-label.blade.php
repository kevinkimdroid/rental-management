@props(['value'])

<label {{ $attributes->merge(['class' => 'mb-2 block text-base font-medium text-zinc-700']) }}>
    {{ $value ?? $slot }}
</label>
