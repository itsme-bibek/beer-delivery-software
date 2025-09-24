@extends('frontend.users.layouts.app')

@section('main')
<div class="px-6 py-4">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-xl font-semibold">Invoice {{ $invoice->invoice_number }}</h1>
        <a href="{{ route('user.invoices.download', $invoice) }}" class="px-3 py-2 bg-blue-600 text-white rounded">Download PDF</a>
    </div>
    <div class="bg-white shadow rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <div class="text-sm text-gray-500">Billed To</div>
                <div class="text-gray-900 font-medium">{{ $invoice->billing_name ?? $invoice->user->name }}</div>
                <div class="text-gray-700">{{ $invoice->billing_email ?? $invoice->user->email }}</div>
                @if($invoice->billing_address)
                <div class="text-gray-700">{{ $invoice->billing_address }}</div>
                @endif
            </div>
            <div class="text-right">
                <div class="text-sm text-gray-500">Issued</div>
                <div class="text-gray-900">{{ optional($invoice->issued_at)->format('Y-m-d') }}</div>
                @if($invoice->type === 'monthly')
                <div class="text-sm text-gray-500 mt-2">Period</div>
                <div class="text-gray-900">{{ $invoice->period_start?->format('Y-m-d') }} – {{ $invoice->period_end?->format('Y-m-d') }}</div>
                @endif
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($orders as $order)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $order->beer->name ?? 'Beer' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $order->quantity ?? 1 }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">${{ number_format($order->beer->price ?? $order->unit_price ?? 0, 2) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 font-medium">${{ number_format($order->total_price ?? (($order->beer->price ?? 0) * ($order->quantity ?? 1)), 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex flex-col items-end space-y-1">
            <div class="text-gray-700">Subtotal: <span class="font-medium">${{ number_format($invoice->subtotal, 2) }}</span></div>
            <div class="text-gray-700">Tax: <span class="font-medium">${{ number_format($invoice->tax, 2) }}</span></div>
            <div class="text-gray-700">Discount: <span class="font-medium">-${{ number_format($invoice->discount, 2) }}</span></div>
            <div class="text-gray-900 text-lg">Total: <span class="font-semibold">${{ number_format($invoice->total, 2) }}</span></div>
        </div>
    </div>
</div>
@endsection


