<x-app-layout>
    <div class="mx-auto max-w-3xl space-y-6">
        <x-page-header :title="__('Edit property')" :subtitle="$property->name">
            <x-slot name="breadcrumb">
                <x-breadcrumb :items="[
                    ['label' => 'Properties', 'url' => route('properties.index')],
                    ['label' => $property->name, 'url' => route('properties.show', $property)],
                    ['label' => 'Edit'],
                ]" />
            </x-slot>
        </x-page-header>

        <x-flash />

        <form method="POST" action="{{ route('properties.update', $property) }}">
            @csrf @method('PUT')
            <x-section-card title="Property information">
                @include('properties._form')
                <div class="form-actions mt-6 border-t-0 pt-0">
                    <x-btn variant="secondary" :href="route('properties.show', $property)">Cancel</x-btn>
                    <x-btn type="submit">Save changes</x-btn>
                </div>
            </x-section-card>
        </form>
    </div>
</x-app-layout>
