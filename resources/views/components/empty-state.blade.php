@props(['icon' => 'inbox', 'title' => 'Nothing here yet', 'description' => null])

<div class="flex flex-col items-center px-6 py-16 text-center">
    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-brand-50 text-brand-600 ring-1 ring-brand-100/80">
        <x-icon :name="$icon" class="h-7 w-7" />
    </div>
    <p class="mt-5 text-lg font-semibold text-zinc-800">{{ $title }}</p>
    @if ($description)
        <p class="mt-2 max-w-sm text-base leading-relaxed text-zinc-500">{{ $description }}</p>
    @endif
    @isset($action)
        <div class="mt-6">{{ $action }}</div>
    @endisset
</div>
