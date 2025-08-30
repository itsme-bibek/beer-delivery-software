<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Preview - {{ $groupCode }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #374151;
            background: #f9fafb;
        }

        .invoice-container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            padding: 30px;
        }

        /* Header */
        .header {
            text-align: center;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 16px;
            margin-bottom: 24px;
        }

        .company-name {
            font-size: 28px;
            font-weight: 700;
            color: #2563eb;
            margin-bottom: 4px;
        }

        .company-tagline {
            font-size: 13px;
            color: #6b7280;
        }

        /* Action buttons */
        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-bottom: 20px;
        }

        .button {
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            font-weight: 600;
            font-size: 14px;
            transition: background 0.2s ease;
        }

        .button-download {
            background: #059669;
        }

        .button-download:hover {
            background: #047857;
        }

        .button-print {
            background: #2563eb;
        }

        .button-print:hover {
            background: #1e40af;
        }

        /* Invoice + customer details */
        .invoice-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 28px;
        }

        .info-box {
            background: #f9fafb;
            padding: 16px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .info-box h3 {
            margin: 0 0 10px 0;
            font-size: 15px;
            font-weight: 600;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 6px;
        }

        .info-box p {
            margin: 6px 0;
            font-size: 14px;
            color: #4b5563;
        }

        .info-box strong {
            color: #111827;
        }

        /* Items table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }

        .items-table th {
            background: #f3f4f6;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            color: #374151;
            border-bottom: 2px solid #d1d5db;
        }

        .items-table td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        .beer-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .beer-info img {
            width: 45px;
            height: 45px;
            border-radius: 6px;
            object-fit: cover;
            border: 1px solid #e5e7eb;
        }

        .beer-info div {
            line-height: 1.3;
        }

        .beer-info strong {
            font-size: 14px;
        }

        .beer-info small {
            font-size: 12px;
            color: #6b7280;
        }

        /* Totals */
        .total-section {
            display: grid;
            justify-content: flex-end;
            gap: 6px;
            text-align: right;
        }

        .total-row {
            font-size: 15px;
            color: #374151;
        }

        .grand-total {
            font-size: 18px;
            font-weight: 700;
            color: #059669;
            margin-top: 6px;
            border-top: 2px solid #10b981;
            padding-top: 8px;
        }

        /* Status */
        .status-badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-processing {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-shipped {
            background: #e9d5ff;
            color: #7c3aed;
        }

        .status-delivered {
            background: #d1fae5;
            color: #065f46;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Footer */
        .footer {
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            padding-top: 18px;
            margin-top: 28px;
            border-top: 1px solid #e5e7eb;
        }

        @media print {
            body {
                background: #fff;
                padding: 0;
            }

            .actions {
                display: none;
            }

            .invoice-container {
                box-shadow: none;
                border: none;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="header">
            <div class="company-name">peaksip</div>
            <div class="company-tagline">Premium Craft Beer Delivery</div>
        </div>

        <!-- Actions -->
        <div class="actions">
            <a class="button button-download" href="{{ route('invoice.download', $groupCode) }}">⬇ Download PDF</a>
            <a class="button button-print" href="#" onclick="window.print(); return false;">🖨 Print</a>
        </div>

        <!-- Invoice + Customer -->
        <div class="invoice-details">
            <div class="info-box">
                <h3>Invoice Details</h3>
                <p><strong>Invoice #:</strong> {{ $groupCode }}</p>
                <p><strong>Date:</strong> {{ $orderDate->format('M d, Y') }}</p>
                <p><strong>Time:</strong> {{ $orderDate->format('H:i A') }}</p>
                <p><strong>Payment:</strong>
                    @if ($paymentMethod === 'cod')
                        Cash on Delivery 💵
                    @else
                        Card Payment 💳
                    @endif
                </p>
            </div>

            <div class="info-box">
                <h3>Customer Info</h3>
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Status:</strong>
                    <span class="status-badge status-{{ strtolower($orders->first()->status) }}">
                        {{ $orders->first()->status }}
                    </span>
                </p>
            </div>
        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width:45%">Item</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>
                            <div class="beer-info">
                                <img src="{{ asset('storage/' . $order->image) }}" alt="{{ $order->beer->name }}">
                                <div>
                                    <strong>{{ $order->beer->name }}</strong><br>
                                    <small>{{ $order->beer->description ?? 'Premium craft beer' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $order->quantity }}</td>
                        <td>${{ number_format($order->beer->price, 2) }}</td>
                        <td>${{ number_format($order->total_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="total-section">
            <div class="total-row"><strong>Total Items:</strong> {{ $totalItems }}</div>
            <div class="total-row"><strong>Subtotal:</strong> ${{ number_format($totalAmount, 2) }}</div>
            <div class="total-row"><strong>Tax:</strong> $0.00</div>
            <div class="total-row"><strong>Shipping:</strong> $0.00</div>
            <div class="grand-total"><strong>Grand Total:</strong> ${{ number_format($totalAmount, 2) }}</div>
        </div>

        <!-- Footer -->
        <div class="footer">
            Thank you for choosing <strong>peaksip</strong>! <br>
            For questions, contact: support@peaksip.com <br>
            <em>This is a computer-generated invoice. No signature required.</em>
        </div>
    </div>
</body>

</html>
