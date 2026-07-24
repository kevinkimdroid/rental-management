@props(['title', 'description' => null, 'action' => null])

<section {{ $attributes->merge(['class' => 'surface overflow-hidden']) }}>
    <div class="surface-header">
        <div>
            <h2 class="text-lg font-semibold text-zinc-900">{{ $title }}</h2>
            @if ($description)
                <p class="mt-1 text-sm text-zinc-500">{{ $description }}</p>
            @endif
        </div>
        @if ($action)
            <div>{{ $action }}</div>
        @endif
    </div>
    <div class="p-6">
        {{ $slot }}
    </div>
</section>
