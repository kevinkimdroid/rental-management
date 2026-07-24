@props(['title', 'description' => null])

<div {{ $attributes->merge(['class' => 'border-b border-zinc-100 pb-5']) }}>
    <h3 class="text-base font-semibold text-zinc-900">{{ $title }}</h3>
    @if ($description)
        <p class="mt-1 text-sm text-zinc-500">{{ $description }}</p>
    @endif
</div>
