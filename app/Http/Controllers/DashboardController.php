<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRequest;
use App\Models\Payment;
use App\Models\Property;
use App\Models\Tenant;
use App\Models\Unit;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $propertyCount = Property::where('user_id', $userId)->count();

        $unitsQuery = Unit::whereHas('property', fn ($q) => $q->where('user_id', $userId));
        $unitCount = (clone $unitsQuery)->count();
        $occupiedUnitCount = (clone $unitsQuery)->where('status', 'occupied')->count();
        $vacantUnitCount = (clone $unitsQuery)->where('status', 'vacant')->count();

        $tenantCount = Tenant::count();

        $rentDue = Payment::whereHas('lease.unit.property', fn ($q) => $q->where('user_id', $userId))
            ->whereIn('status', ['pending', 'overdue'])
            ->sum('amount');

        $openMaintenanceCount = MaintenanceRequest::whereHas('unit.property', fn ($q) => $q->where('user_id', $userId))
            ->whereIn('status', ['open', 'in_progress'])
            ->count();

        $recentPayments = Payment::with('lease.unit.property', 'lease.tenant')
            ->whereHas('lease.unit.property', fn ($q) => $q->where('user_id', $userId))
            ->latest('due_date')
            ->take(5)
            ->get();

        $recentMaintenanceRequests = MaintenanceRequest::with('unit.property', 'tenant')
            ->whereHas('unit.property', fn ($q) => $q->where('user_id', $userId))
            ->latest('reported_at')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'propertyCount',
            'unitCount',
            'occupiedUnitCount',
            'vacantUnitCount',
            'tenantCount',
            'rentDue',
            'openMaintenanceCount',
            'recentPayments',
            'recentMaintenanceRequests',
        ));
    }
}
