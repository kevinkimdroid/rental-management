@php($lease = $lease ?? null)

<div class="form-grid sm:grid-cols-2">
    <div class="sm:col-span-2">
        <x-input-label for="unit_id" value="Unit" />
        <x-select id="unit_id" name="unit_id" class="mt-1.5" required>
            <option value="">Select a unit</option>
            @foreach ($units as $u)
                <option value="{{ $u->id }}" @selected(old('unit_id', $lease?->unit_id) == $u->id)>{{ $u->property->name }} — {{ $u->unit_number }}</option>
            @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('unit_id')" class="mt-2" />
    </div>

    <div class="sm:col-span-2">
        <x-input-label for="tenant_id" value="Tenant" />
        <x-select id="tenant_id" name="tenant_id" class="mt-1.5" required>
            <option value="">Select a tenant</option>
            @foreach ($tenants as $t)
                <option value="{{ $t->id }}" @selected(old('tenant_id', $lease?->tenant_id) == $t->id)>{{ $t->full_name }}</option>
            @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('tenant_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="start_date" value="Start Date" />
        <x-text-input id="start_date" name="start_date" type="date" class="mt-1.5 block w-full" :value="old('start_date', $lease?->start_date?->format('Y-m-d'))" required />
        <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="end_date" value="End Date" />
        <x-text-input id="end_date" name="end_date" type="date" class="mt-1.5 block w-full" :value="old('end_date', $lease?->end_date?->format('Y-m-d'))" />
        <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="rent_amount" value="Rent Amount" />
        <x-text-input id="rent_amount" name="rent_amount" type="number" step="0.01" min="0" class="mt-1.5 block w-full" :value="old('rent_amount', $lease?->rent_amount)" required />
        <x-input-error :messages="$errors->get('rent_amount')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="deposit_amount" value="Deposit Amount" />
        <x-text-input id="deposit_amount" name="deposit_amount" type="number" step="0.01" min="0" class="mt-1.5 block w-full" :value="old('deposit_amount', $lease?->deposit_amount)" required />
        <x-input-error :messages="$errors->get('deposit_amount')" class="mt-2" />
    </div>

    <div class="sm:col-span-2">
        <x-input-label for="status" value="Status" />
        <x-select id="status" name="status" class="mt-1.5" required>
            @foreach (['active' => 'Active', 'ended' => 'Ended', 'terminated' => 'Terminated'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $lease?->status ?? 'active') === $value)>{{ $label }}</option>
            @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('status')" class="mt-2" />
    </div>
</div>
