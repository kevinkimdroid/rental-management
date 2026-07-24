@php($maintenanceRequest = $maintenanceRequest ?? null)

<div class="form-grid sm:grid-cols-2">
    <div class="sm:col-span-2">
        <x-input-label for="unit_id" value="Unit" />
        <x-select id="unit_id" name="unit_id" class="mt-1.5" required>
            <option value="">Select a unit</option>
            @foreach ($units as $u)
                <option value="{{ $u->id }}" @selected(old('unit_id', $maintenanceRequest?->unit_id) == $u->id)>{{ $u->property->name }} — {{ $u->unit_number }}</option>
            @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('unit_id')" class="mt-2" />
    </div>

    <div class="sm:col-span-2">
        <x-input-label for="tenant_id" value="Tenant (optional)" />
        <x-select id="tenant_id" name="tenant_id" class="mt-1.5">
            <option value="">—</option>
            @foreach ($tenants as $t)
                <option value="{{ $t->id }}" @selected(old('tenant_id', $maintenanceRequest?->tenant_id) == $t->id)>{{ $t->full_name }}</option>
            @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('tenant_id')" class="mt-2" />
    </div>

    <div class="sm:col-span-2">
        <x-input-label for="title" value="Issue Title" />
        <x-text-input id="title" name="title" type="text" class="mt-1.5 block w-full" :value="old('title', $maintenanceRequest?->title)" required placeholder="e.g. Leaking kitchen tap" />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div class="sm:col-span-2">
        <x-input-label for="description" value="Description" />
        <x-textarea id="description" name="description" rows="4" class="mt-1.5" placeholder="Describe the issue in detail...">{{ old('description', $maintenanceRequest?->description) }}</x-textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="priority" value="Priority" />
        <x-select id="priority" name="priority" class="mt-1.5" required>
            @foreach (['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'] as $value => $label)
                <option value="{{ $value }}" @selected(old('priority', $maintenanceRequest?->priority ?? 'medium') === $value)>{{ $label }}</option>
            @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('priority')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="status" value="Status" />
        <x-select id="status" name="status" class="mt-1.5" required>
            @foreach (['open' => 'Open', 'in_progress' => 'In Progress', 'resolved' => 'Resolved'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $maintenanceRequest?->status ?? 'open') === $value)>{{ $label }}</option>
            @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('status')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="reported_at" value="Reported Date" />
        <x-text-input id="reported_at" name="reported_at" type="date" class="mt-1.5 block w-full" :value="old('reported_at', $maintenanceRequest?->reported_at?->format('Y-m-d') ?? now()->format('Y-m-d'))" required />
        <x-input-error :messages="$errors->get('reported_at')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="resolved_at" value="Resolved Date" />
        <x-text-input id="resolved_at" name="resolved_at" type="date" class="mt-1.5 block w-full" :value="old('resolved_at', $maintenanceRequest?->resolved_at?->format('Y-m-d'))" />
        <x-input-error :messages="$errors->get('resolved_at')" class="mt-2" />
    </div>
</div>
