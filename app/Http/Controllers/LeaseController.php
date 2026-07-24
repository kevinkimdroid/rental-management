<?php

namespace App\Http\Controllers;

use App\Models\Lease;
use App\Models\Tenant;
use App\Models\Unit;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    public function index()
    {
        $leases = Lease::with('unit.property', 'tenant')
            ->whereHas('unit.property', fn ($q) => $q->where('user_id', auth()->id()))
            ->latest()
            ->paginate(10);

        return view('leases.index', compact('leases'));
    }

    public function create()
    {
        $units = Unit::whereHas('property', fn ($q) => $q->where('user_id', auth()->id()))->get();
        $tenants = Tenant::all();

        return view('leases.create', compact('units', 'tenants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'unit_id' => ['required', 'exists:units,id'],
            'tenant_id' => ['required', 'exists:tenants,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after:start_date'],
            'rent_amount' => ['required', 'numeric', 'min:0'],
            'deposit_amount' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:active,ended,terminated'],
        ]);

        $lease = Lease::create($validated);

        if ($lease->status === 'active') {
            $lease->unit()->update(['status' => 'occupied']);
        }

        return redirect()->route('leases.index')->with('status', 'Lease created successfully.');
    }

    public function show(Lease $lease)
    {
        $lease->load('unit.property', 'tenant', 'payments');

        return view('leases.show', compact('lease'));
    }

    public function edit(Lease $lease)
    {
        $units = Unit::whereHas('property', fn ($q) => $q->where('user_id', auth()->id()))->get();
        $tenants = Tenant::all();

        return view('leases.edit', compact('lease', 'units', 'tenants'));
    }

    public function update(Request $request, Lease $lease)
    {
        $validated = $request->validate([
            'unit_id' => ['required', 'exists:units,id'],
            'tenant_id' => ['required', 'exists:tenants,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after:start_date'],
            'rent_amount' => ['required', 'numeric', 'min:0'],
            'deposit_amount' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:active,ended,terminated'],
        ]);

        $lease->update($validated);

        if ($lease->status === 'active') {
            $lease->unit()->update(['status' => 'occupied']);
        } elseif (in_array($lease->status, ['ended', 'terminated'])) {
            $lease->unit()->update(['status' => 'vacant']);
        }

        return redirect()->route('leases.index')->with('status', 'Lease updated successfully.');
    }

    public function destroy(Lease $lease)
    {
        $lease->delete();

        return redirect()->route('leases.index')->with('status', 'Lease deleted.');
    }
}
