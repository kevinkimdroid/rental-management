<x-app-layout>
    <x-slot name="header">
        <x-page-header :title="__('Add Tenant')" />
    </x-slot>

    <div class="mx-auto max-w-3xl space-y-6">
        <x-flash />
        <x-card>
            <form method="POST" action="{{ route('tenants.store') }}" class="space-y-6">
                @csrf
                @include('tenants._form')

                <div class="form-actions">
                    <x-btn variant="secondary" :href="route('tenants.index')">{{ __('Cancel') }}</x-btn>
                    <x-btn type="submit">{{ __('Save Tenant') }}</x-btn>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
