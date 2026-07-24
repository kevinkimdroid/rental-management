<?php

namespace App\Http\Controllers;

use App\Models\Lease;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('lease.unit.property', 'lease.tenant')
            ->whereHas('lease.unit.property', fn ($q) => $q->where('user_id', auth()->id()))
            ->latest('due_date')
            ->paginate(10);

        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $leases = Lease::with('unit.property', 'tenant')
            ->whereHas('unit.property', fn ($q) => $q->where('user_id', auth()->id()))
            ->get();

        return view('payments.create', compact('leases'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lease_id' => ['required', 'exists:leases,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'due_date' => ['required', 'date'],
            'paid_date' => ['nullable', 'date'],
            'method' => ['nullable', 'in:cash,bank_transfer,mpesa,card'],
            'reference_number' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:pending,paid,overdue'],
        ]);

        Payment::create($validated);

        return redirect()->route('payments.index')->with('status', 'Payment recorded successfully.');
    }

    public function show(Payment $payment)
    {
        $payment->load('lease.unit.property', 'lease.tenant');

        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $leases = Lease::with('unit.property', 'tenant')
            ->whereHas('unit.property', fn ($q) => $q->where('user_id', auth()->id()))
            ->get();

        return view('payments.edit', compact('payment', 'leases'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'lease_id' => ['required', 'exists:leases,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'due_date' => ['required', 'date'],
            'paid_date' => ['nullable', 'date'],
            'method' => ['nullable', 'in:cash,bank_transfer,mpesa,card'],
            'reference_number' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:pending,paid,overdue'],
        ]);

        $payment->update($validated);

        return redirect()->route('payments.index')->with('status', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')->with('status', 'Payment deleted.');
    }
}
