<x-app-layout>
    <x-slot name="header">
        <x-page-header :title="__('Edit Lease')" />
    </x-slot>

    <div class="mx-auto max-w-3xl space-y-6">
        <x-flash />
        <x-card>
            <form method="POST" action="{{ route('leases.update', $lease) }}" class="space-y-6">
                @csrf
                @method('PUT')
                @include('leases._form')

                <div class="form-actions">
                    <x-btn variant="secondary" :href="route('leases.index')">{{ __('Cancel') }}</x-btn>
                    <x-btn type="submit">{{ __('Update Lease') }}</x-btn>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
