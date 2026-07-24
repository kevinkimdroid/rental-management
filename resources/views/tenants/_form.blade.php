@php($tenant = $tenant ?? null)

<div class="form-grid sm:grid-cols-2">
    <div>
        <x-input-label for="first_name" value="First Name" />
        <x-text-input id="first_name" name="first_name" type="text" class="mt-1.5 block w-full" :value="old('first_name', $tenant?->first_name)" required autofocus />
        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="last_name" value="Last Name" />
        <x-text-input id="last_name" name="last_name" type="text" class="mt-1.5 block w-full" :value="old('last_name', $tenant?->last_name)" required />
        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="email" value="Email" />
        <x-text-input id="email" name="email" type="email" class="mt-1.5 block w-full" :value="old('email', $tenant?->email)" required />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="phone" value="Phone" />
        <x-text-input id="phone" name="phone" type="text" class="mt-1.5 block w-full" :value="old('phone', $tenant?->phone)" required />
        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="id_number" value="ID Number" />
        <x-text-input id="id_number" name="id_number" type="text" class="mt-1.5 block w-full" :value="old('id_number', $tenant?->id_number)" />
        <x-input-error :messages="$errors->get('id_number')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="emergency_contact" value="Emergency Contact" />
        <x-text-input id="emergency_contact" name="emergency_contact" type="text" class="mt-1.5 block w-full" :value="old('emergency_contact', $tenant?->emergency_contact)" />
        <x-input-error :messages="$errors->get('emergency_contact')" class="mt-2" />
    </div>
</div>
