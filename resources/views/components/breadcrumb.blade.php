@props(['items'])

<nav aria-label="Breadcrumb" class="mb-4">
    <ol class="flex flex-wrap items-center gap-2 text-base">
        @foreach ($items as $index => $item)
            <li class="flex items-center gap-1.5">
                @if ($index > 0)
                    <svg class="h-4 w-4 text-zinc-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                @endif
                @if (! empty($item['url']) && $index < count($items) - 1)
                    <a href="{{ $item['url'] }}" class="font-medium text-zinc-500 transition hover:text-brand-700">{{ $item['label'] }}</a>
                @else
                    <span class="font-medium text-zinc-900">{{ $item['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
