<x-app-layout>
    <div class="mx-auto max-w-7xl space-y-6">
        <x-page-header :title="__('Payments')" subtitle="Rent collection and billing" :count="$payments->total()">
            <x-slot name="actions"><x-btn :href="route('payments.create')"><x-icon name="plus" class="h-4 w-4" /> Record payment</x-btn></x-slot>
        </x-page-header>
        <x-flash />
        <div class="surface overflow-hidden">
            <table class="table-shell min-w-full">
                <thead><tr><th>Payment</th><th>Due date</th><th>Amount</th><th>Status</th><th class="text-right">Actions</th></tr></thead>
                <tbody>
                    @forelse ($payments as $payment)
                        <tr>
                            <td><div class="flex items-center gap-3"><span class="entity-row-icon"><x-icon name="banknotes" class="h-5 w-5" /></span><div><a href="{{ route('payments.show', $payment) }}" class="font-medium text-zinc-900 hover:text-brand-700">{{ $payment->lease->tenant->full_name }}</a><p class="text-sm text-zinc-400">Unit {{ $payment->lease->unit->unit_number }}</p></div></div></td>
                            <td class="tabular-nums">{{ $payment->due_date->format('M j, Y') }}</td>
                            <td class="font-semibold tabular-nums">KES {{ number_format($payment->amount, 0) }}</td>
                            <td><x-badge :color="match($payment->status) { 'paid' => 'green', 'overdue' => 'red', default => 'yellow' }">{{ $payment->status }}</x-badge></td>
                            <td class="text-right"><a href="{{ route('payments.show', $payment) }}" class="text-sm font-medium text-zinc-500 hover:text-brand-700">View</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="5"><x-empty-state icon="banknotes" title="No payments" /></td></tr>
                    @endforelse
                </tbody>
            </table>
            @if ($payments->hasPages())<div class="border-t border-zinc-100 px-6 py-4">{{ $payments->links() }}</div>@endif
        </div>
    </div>
</x-app-layout>
