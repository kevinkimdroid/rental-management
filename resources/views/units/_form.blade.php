@php($unit = $unit ?? null)

<div class="form-grid sm:grid-cols-2">
    <div class="sm:col-span-2">
        <x-input-label for="property_id" value="Property" />
        <x-select id="property_id" name="property_id" class="mt-1.5" required>
            <option value="">Select a property</option>
            @foreach ($properties as $property)
                <option value="{{ $property->id }}" @selected(old('property_id', $unit?->property_id) == $property->id)>{{ $property->name }}</option>
            @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('property_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="unit_number" value="Unit Number" />
        <x-text-input id="unit_number" name="unit_number" type="text" class="mt-1.5 block w-full" :value="old('unit_number', $unit?->unit_number)" required placeholder="A-101" />
        <x-input-error :messages="$errors->get('unit_number')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="rent_amount" value="Monthly Rent" />
        <x-text-input id="rent_amount" name="rent_amount" type="number" step="0.01" min="0" class="mt-1.5 block w-full" :value="old('rent_amount', $unit?->rent_amount)" required />
        <x-input-error :messages="$errors->get('rent_amount')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="bedrooms" value="Bedrooms" />
        <x-text-input id="bedrooms" name="bedrooms" type="number" min="0" class="mt-1.5 block w-full" :value="old('bedrooms', $unit?->bedrooms ?? 1)" required />
        <x-input-error :messages="$errors->get('bedrooms')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="bathrooms" value="Bathrooms" />
        <x-text-input id="bathrooms" name="bathrooms" type="number" min="0" class="mt-1.5 block w-full" :value="old('bathrooms', $unit?->bathrooms ?? 1)" required />
        <x-input-error :messages="$errors->get('bathrooms')" class="mt-2" />
    </div>

    <div class="sm:col-span-2">
        <x-input-label for="status" value="Status" />
        <x-select id="status" name="status" class="mt-1.5" required>
            @foreach (['vacant' => 'Vacant', 'occupied' => 'Occupied', 'maintenance' => 'Maintenance'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $unit?->status) === $value)>{{ $label }}</option>
            @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('status')" class="mt-2" />
    </div>

    <div class="sm:col-span-2">
        <x-input-label for="description" value="Description" />
        <x-textarea id="description" name="description" rows="3" class="mt-1.5">{{ old('description', $unit?->description) }}</x-textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>
</div>
