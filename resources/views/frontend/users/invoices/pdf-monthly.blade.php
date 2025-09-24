<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .title { font-size: 18px; font-weight: bold; }
        table { width:100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border:1px solid #ddd; padding:8px; }
        th { background:#f3f4f6; text-align:left; }
        .totals { margin-top: 12px; float:right; }
        .totals table { width: auto; }
    </style>
    <title>Monthly Invoice - {{ $monthLabel }}</title>
</head>
<body>
    <div class="title">Monthly Invoice - {{ $monthLabel }}</div>
    <div>Customer: {{ $invoice->billing_name ?? $invoice->user->name }}</div>
    <div>Email: {{ $invoice->billing_email ?? $invoice->user->email }}</div>
    <div>Period: {{ $invoice->period_start?->format('Y-m-d') }} – {{ $invoice->period_end?->format('Y-m-d') }}</div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Group</th>
                <th>Item</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                <td>{{ $order->group_code }}</td>
                <td>{{ $order->beer->name ?? 'Beer' }}</td>
                <td>{{ $order->quantity ?? 1 }}</td>
                <td>${{ number_format($order->beer->price ?? $order->unit_price ?? 0, 2) }}</td>
                <td>${{ number_format($order->total_price ?? (($order->beer->price ?? 0) * ($order->quantity ?? 1)), 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <table>
            <tr><td>Subtotal</td><td>${{ number_format($invoice->subtotal, 2) }}</td></tr>
            <tr><td>Tax</td><td>${{ number_format($invoice->tax, 2) }}</td></tr>
            <tr><td>Discount</td><td>-${{ number_format($invoice->discount, 2) }}</td></tr>
            <tr><td><strong>Total</strong></td><td><strong>${{ number_format($invoice->total, 2) }}</strong></td></tr>
        </table>
    </div>
</body>
</html>


