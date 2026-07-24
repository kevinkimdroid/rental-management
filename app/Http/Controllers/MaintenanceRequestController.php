<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRequest;
use App\Models\Tenant;
use App\Models\Unit;
use Illuminate\Http\Request;

class MaintenanceRequestController extends Controller
{
    public function index()
    {
        $maintenanceRequests = MaintenanceRequest::with('unit.property', 'tenant')
            ->whereHas('unit.property', fn ($q) => $q->where('user_id', auth()->id()))
            ->latest('reported_at')
            ->paginate(10);

        return view('maintenance-requests.index', compact('maintenanceRequests'));
    }

    public function create()
    {
        $units = Unit::whereHas('property', fn ($q) => $q->where('user_id', auth()->id()))->get();
        $tenants = Tenant::all();

        return view('maintenance-requests.create', compact('units', 'tenants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'unit_id' => ['required', 'exists:units,id'],
            'tenant_id' => ['nullable', 'exists:tenants,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'priority' => ['required', 'in:low,medium,high'],
            'status' => ['required', 'in:open,in_progress,resolved'],
            'reported_at' => ['required', 'date'],
            'resolved_at' => ['nullable', 'date', 'after_or_equal:reported_at'],
        ]);

        MaintenanceRequest::create($validated);

        return redirect()->route('maintenance-requests.index')->with('status', 'Maintenance request logged successfully.');
    }

    public function show(MaintenanceRequest $maintenanceRequest)
    {
        $maintenanceRequest->load('unit.property', 'tenant');

        return view('maintenance-requests.show', compact('maintenanceRequest'));
    }

    public function edit(MaintenanceRequest $maintenanceRequest)
    {
        $units = Unit::whereHas('property', fn ($q) => $q->where('user_id', auth()->id()))->get();
        $tenants = Tenant::all();

        return view('maintenance-requests.edit', compact('maintenanceRequest', 'units', 'tenants'));
    }

    public function update(Request $request, MaintenanceRequest $maintenanceRequest)
    {
        $validated = $request->validate([
            'unit_id' => ['required', 'exists:units,id'],
            'tenant_id' => ['nullable', 'exists:tenants,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'priority' => ['required', 'in:low,medium,high'],
            'status' => ['required', 'in:open,in_progress,resolved'],
            'reported_at' => ['required', 'date'],
            'resolved_at' => ['nullable', 'date', 'after_or_equal:reported_at'],
        ]);

        $maintenanceRequest->update($validated);

        return redirect()->route('maintenance-requests.index')->with('status', 'Maintenance request updated successfully.');
    }

    public function destroy(MaintenanceRequest $maintenanceRequest)
    {
        $maintenanceRequest->delete();

        return redirect()->route('maintenance-requests.index')->with('status', 'Maintenance request deleted.');
    }
}
