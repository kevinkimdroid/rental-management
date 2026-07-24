<x-app-layout>
    <div class="mx-auto max-w-3xl space-y-6">
        <x-page-header title="Account settings" subtitle="Manage your profile and security" />

        <x-section-card title="Profile information" description="Update your name and email address.">
            @include('profile.partials.update-profile-information-form')
        </x-section-card>

        <x-section-card title="Password" description="Ensure your account uses a strong, unique password.">
            @include('profile.partials.update-password-form')
        </x-section-card>

        <x-section-card title="Delete account" description="Permanently remove your account and all associated data.">
            @include('profile.partials.delete-user-form')
        </x-section-card>
    </div>
</x-app-layout>
