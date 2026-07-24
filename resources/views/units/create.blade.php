<x-app-layout>
    <x-slot name="header">
        <x-page-header :title="__('Add Unit')" />
    </x-slot>

    <div class="mx-auto max-w-3xl space-y-6">
        <x-flash />
        <x-card>
            <form method="POST" action="{{ route('units.store') }}" class="space-y-6">
                @csrf
                @include('units._form')

                <div class="form-actions">
                    <x-btn variant="secondary" :href="route('units.index')">{{ __('Cancel') }}</x-btn>
                    <x-btn type="submit">{{ __('Save Unit') }}</x-btn>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
