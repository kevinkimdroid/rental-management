<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::with('property')
            ->whereHas('property', fn ($q) => $q->where('user_id', auth()->id()))
            ->latest()
            ->paginate(10);

        return view('units.index', compact('units'));
    }

    public function create()
    {
        $properties = Property::where('user_id', auth()->id())->get();

        return view('units.create', compact('properties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'unit_number' => ['required', 'string', 'max:255'],
            'bedrooms' => ['required', 'integer', 'min:0'],
            'bathrooms' => ['required', 'integer', 'min:0'],
            'rent_amount' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:vacant,occupied,maintenance'],
            'description' => ['nullable', 'string'],
        ]);

        Unit::create($validated);

        return redirect()->route('units.index')->with('status', 'Unit created successfully.');
    }

    public function show(Unit $unit)
    {
        $unit->load('property', 'leases.tenant', 'maintenanceRequests');

        return view('units.show', compact('unit'));
    }

    public function edit(Unit $unit)
    {
        $properties = Property::where('user_id', auth()->id())->get();

        return view('units.edit', compact('unit', 'properties'));
    }

    public function update(Request $request, Unit $unit)
    {
        $validated = $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'unit_number' => ['required', 'string', 'max:255'],
            'bedrooms' => ['required', 'integer', 'min:0'],
            'bathrooms' => ['required', 'integer', 'min:0'],
            'rent_amount' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:vacant,occupied,maintenance'],
            'description' => ['nullable', 'string'],
        ]);

        $unit->update($validated);

        return redirect()->route('units.index')->with('status', 'Unit updated successfully.');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();

        return redirect()->route('units.index')->with('status', 'Unit deleted.');
    }
}
