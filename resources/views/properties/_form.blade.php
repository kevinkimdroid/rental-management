@php($property = $property ?? null)

<div class="form-grid sm:grid-cols-2">
    <div class="sm:col-span-2">
        <x-input-label for="name" value="Property Name" />
        <x-text-input id="name" name="name" type="text" class="mt-1.5 block w-full" :value="old('name', $property?->name)" required autofocus placeholder="e.g. Sunset Apartments" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div class="sm:col-span-2">
        <x-input-label for="address_line" value="Street Address" />
        <x-text-input id="address_line" name="address_line" type="text" class="mt-1.5 block w-full" :value="old('address_line', $property?->address_line)" required placeholder="123 Main Street" />
        <x-input-error :messages="$errors->get('address_line')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="city" value="City" />
        <x-text-input id="city" name="city" type="text" class="mt-1.5 block w-full" :value="old('city', $property?->city)" required />
        <x-input-error :messages="$errors->get('city')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="type" value="Property Type" />
        <x-select id="type" name="type" class="mt-1.5" required>
            @foreach (['residential' => 'Residential', 'commercial' => 'Commercial'] as $value => $label)
                <option value="{{ $value }}" @selected(old('type', $property?->type) === $value)>{{ $label }}</option>
            @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('type')" class="mt-2" />
    </div>

    <div class="sm:col-span-2">
        <x-input-label for="description" value="Description" />
        <x-textarea id="description" name="description" rows="4" class="mt-1.5" placeholder="Optional notes about this property...">{{ old('description', $property?->description) }}</x-textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>
</div>
