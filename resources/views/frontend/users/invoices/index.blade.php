@extends('frontend.users.layouts.app')

@section('main')
<div class="px-6 py-4">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-xl font-semibold">My Invoices</h1>
        <form class="flex items-center space-x-2" method="GET" action="{{ route('user.invoices.download-monthly') }}">
            <input type="month" name="month" class="px-3 py-2 border border-gray-300 rounded" required>
            <button class="px-3 py-2 bg-blue-600 text-white rounded">Download Monthly PDF</button>
        </form>
    </div>
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice #</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Issued</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($invoices as $invoice)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $invoice->invoice_number }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700 capitalize">{{ $invoice->type }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ optional($invoice->issued_at)->format('Y-m-d') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900 font-semibold">${{ number_format($invoice->total, 2) }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('user.invoices.show', $invoice) }}" class="text-blue-600 hover:underline mr-3">View</a>
                        <a href="{{ route('user.invoices.download', $invoice) }}" class="text-blue-600 hover:underline">PDF</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">No invoices yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $invoices->links() }}</div>
    <div class="mt-8">
        <h2 class="text-sm font-medium text-gray-700 mb-2">Quick Monthly Download</h2>
        <form class="flex items-center space-x-2" method="GET" action="{{ route('user.invoices.download-monthly') }}">
            <input type="month" name="month" class="px-3 py-2 border border-gray-300 rounded" required>
            <button class="px-3 py-2 bg-blue-600 text-white rounded">Download</button>
        </form>
    </div>
</div>
@endsection


