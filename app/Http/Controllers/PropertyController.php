<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::withCount('units')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('properties.index', compact('properties'));
    }

    public function create()
    {
        return view('properties.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address_line' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:residential,commercial'],
            'description' => ['nullable', 'string'],
        ]);

        $validated['user_id'] = auth()->id();

        Property::create($validated);

        return redirect()->route('properties.index')->with('status', 'Property created successfully.');
    }

    public function show(Property $property)
    {
        $property->load('units.activeLease.tenant');

        return view('properties.show', compact('property'));
    }

    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address_line' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:residential,commercial'],
            'description' => ['nullable', 'string'],
        ]);

        $property->update($validated);

        return redirect()->route('properties.index')->with('status', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()->route('properties.index')->with('status', 'Property deleted.');
    }
}
