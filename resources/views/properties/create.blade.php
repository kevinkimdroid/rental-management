<x-app-layout>
    <div class="mx-auto max-w-3xl space-y-6">
        <x-page-header :title="__('Add property')" subtitle="Register a new building in your portfolio">
            <x-slot name="breadcrumb">
                <x-breadcrumb :items="[
                    ['label' => 'Properties', 'url' => route('properties.index')],
                    ['label' => 'Add property'],
                ]" />
            </x-slot>
        </x-page-header>

        <x-flash />

        <form method="POST" action="{{ route('properties.store') }}">
            @csrf
            <x-section-card title="Property information" description="Basic details about the building or complex.">
                @include('properties._form')
                <div class="form-actions mt-6 border-t-0 pt-0">
                    <x-btn variant="secondary" :href="route('properties.index')">Cancel</x-btn>
                    <x-btn type="submit">Save property</x-btn>
                </div>
            </x-section-card>
        </form>
    </div>
</x-app-layout>
