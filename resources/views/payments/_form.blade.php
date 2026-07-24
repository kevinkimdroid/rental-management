@php($payment = $payment ?? null)

<div class="form-grid sm:grid-cols-2">
    <div class="sm:col-span-2">
        <x-input-label for="lease_id" value="Lease" />
        <x-select id="lease_id" name="lease_id" class="mt-1.5" required>
            <option value="">Select a lease</option>
            @foreach ($leases as $l)
                <option value="{{ $l->id }}" @selected(old('lease_id', $payment?->lease_id) == $l->id)>{{ $l->tenant->full_name }} — {{ $l->unit->property->name }} {{ $l->unit->unit_number }}</option>
            @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('lease_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="amount" value="Amount" />
        <x-text-input id="amount" name="amount" type="number" step="0.01" min="0" class="mt-1.5 block w-full" :value="old('amount', $payment?->amount)" required />
        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="status" value="Status" />
        <x-select id="status" name="status" class="mt-1.5" required>
            @foreach (['pending' => 'Pending', 'paid' => 'Paid', 'overdue' => 'Overdue'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $payment?->status ?? 'pending') === $value)>{{ $label }}</option>
            @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('status')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="due_date" value="Due Date" />
        <x-text-input id="due_date" name="due_date" type="date" class="mt-1.5 block w-full" :value="old('due_date', $payment?->due_date?->format('Y-m-d'))" required />
        <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="paid_date" value="Paid Date" />
        <x-text-input id="paid_date" name="paid_date" type="date" class="mt-1.5 block w-full" :value="old('paid_date', $payment?->paid_date?->format('Y-m-d'))" />
        <x-input-error :messages="$errors->get('paid_date')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="method" value="Payment Method" />
        <x-select id="method" name="method" class="mt-1.5">
            <option value="">—</option>
            @foreach (['cash' => 'Cash', 'bank_transfer' => 'Bank Transfer', 'mpesa' => 'M-Pesa', 'card' => 'Card'] as $value => $label)
                <option value="{{ $value }}" @selected(old('method', $payment?->method) === $value)>{{ $label }}</option>
            @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('method')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="reference_number" value="Reference Number" />
        <x-text-input id="reference_number" name="reference_number" type="text" class="mt-1.5 block w-full" :value="old('reference_number', $payment?->reference_number)" placeholder="Transaction ref." />
        <x-input-error :messages="$errors->get('reference_number')" class="mt-2" />
    </div>
</div>
