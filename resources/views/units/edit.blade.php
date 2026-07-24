<x-app-layout>
    <x-slot name="header">
        <x-page-header :title="__('Edit Unit')" />
    </x-slot>

    <div class="mx-auto max-w-3xl space-y-6">
        <x-flash />
        <x-card>
            <form method="POST" action="{{ route('units.update', $unit) }}" class="space-y-6">
                @csrf
                @method('PUT')
                @include('units._form')

                <div class="form-actions">
                    <x-btn variant="secondary" :href="route('units.index')">{{ __('Cancel') }}</x-btn>
                    <x-btn type="submit">{{ __('Update Unit') }}</x-btn>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
