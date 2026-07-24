<x-app-layout>
    <x-slot name="header">
        <x-page-header :title="__('Edit Maintenance Request')" />
    </x-slot>

    <div class="mx-auto max-w-3xl space-y-6">
        <x-flash />
        <x-card>
            <form method="POST" action="{{ route('maintenance-requests.update', $maintenanceRequest) }}" class="space-y-6">
                @csrf
                @method('PUT')
                @include('maintenance-requests._form')

                <div class="form-actions">
                    <x-btn variant="secondary" :href="route('maintenance-requests.index')">{{ __('Cancel') }}</x-btn>
                    <x-btn type="submit">{{ __('Update Request') }}</x-btn>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
