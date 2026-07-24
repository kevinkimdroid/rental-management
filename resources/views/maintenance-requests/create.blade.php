<x-app-layout>
    <x-slot name="header">
        <x-page-header :title="__('Log Maintenance Request')" />
    </x-slot>

    <div class="mx-auto max-w-3xl space-y-6">
        <x-flash />
        <x-card>
            <form method="POST" action="{{ route('maintenance-requests.store') }}" class="space-y-6">
                @csrf
                @include('maintenance-requests._form')

                <div class="form-actions">
                    <x-btn variant="secondary" :href="route('maintenance-requests.index')">{{ __('Cancel') }}</x-btn>
                    <x-btn type="submit">{{ __('Save Request') }}</x-btn>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
