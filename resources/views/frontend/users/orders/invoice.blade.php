<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $groupCode }}</title>
    <style>
        :root {
            --primary: #2563eb;
            --secondary: #f97316;
            --gray-50: #f9fafb;
            --gray-200: #e5e7eb;
            --gray-400: #9ca3af;
            --gray-600: #4b5563;
            --gray-800: #1f2937;
            --success: #059669;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background: #fff;
            color: var(--gray-800);
            font-size: 14px;
        }

        .invoice-container {
            max-width: 900px;
            margin: auto;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            overflow: hidden;
        }

        .header {
            background: var(--primary);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .company-name {
            font-size: 22px;
            font-weight: bold;
        }

        .company-tagline {
            font-size: 12px;
            opacity: 0.9;
        }

        .invoice-content {
            padding: 20px;
        }

        .invoice-header {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-box {
            background: var(--gray-50);
            padding: 12px;
            border-radius: 6px;
        }

        .info-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            border-bottom: 1px solid var(--gray-200);
            padding-bottom: 4px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        .items-table th,
        .items-table td {
            padding: 10px;
            border-bottom: 1px solid var(--gray-200);
            text-align: left;
        }

        .items-table th {
            background: var(--gray-50);
            font-size: 13px;
        }

        .beer-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .beer-image {
            width: 40px;
            height: 40px;
            border-radius: 4px;
            object-fit: cover;
        }

        .beer-name {
            font-weight: 600;
            font-size: 13px;
        }

        .beer-description {
            font-size: 11px;
            color: var(--gray-600);
        }

        .total-section {
            margin-top: 10px;
            padding: 12px;
            border-top: 2px solid var(--gray-200);
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .grand-total {
            font-size: 16px;
            font-weight: bold;
            color: var(--success);
            border-top: 1px solid var(--gray-200);
            padding-top: 6px;
        }

        .footer {
            text-align: center;
            font-size: 11px;
            color: var(--gray-600);
            padding: 10px;
            border-top: 1px solid var(--gray-200);
            margin-top: 10px;
        }

        .status-badge {
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-pending {
            background: #fffbeb;
            color: #f59e0b;
        }

        .status-processing {
            background: #dbeafe;
            color: #2563eb;
        }

        .status-delivered {
            background: #d1fae5;
            color: var(--success);
        }

        @media print {
            body {
                padding: 0;
            }

            .invoice-container {
                border: none;
                box-shadow: none;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="header">
            <div class="company-name">peaksip</div>
            <div class="company-tagline">Premium Craft Beer Delivery</div>
        </div>

        <div class="invoice-content">
            <div class="invoice-header">
                <!-- Invoice Details -->
                <div class="info-box">
                    <div class="info-title">Invoice Details</div>
                    <div class="info-row"><span>Invoice #:</span> <span>{{ $groupCode }}</span></div>
                    <div class="info-row"><span>Date:</span> <span>{{ $orderDate->format('M d, Y') }}</span></div>
                    <div class="info-row"><span>Time:</span> <span>{{ $orderDate->format('H:i A') }}</span></div>
                    <div class="info-row"><span>Payment:</span>
                        <span>
                            @if ($paymentMethod === 'cod')
                                Cash on Delivery 💵
                            @else
                                Card 💳
                            @endif
                        </span>
                    </div>
                </div>

                <!-- Customer Info -->
                <div class="info-box">
                    <div class="info-title">Customer Info</div>
                    <div class="info-row"><span>Name:</span> <span>{{ $user->name }}</span></div>
                    <div class="info-row"><span>Email:</span> <span>{{ $user->email }}</span></div>
                    <div class="info-row"><span>Status:</span>
                        <span class="status-badge status-{{ strtolower($orders->first()->status) }}">
                            {{ $orders->first()->status }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <table class="items-table">
                <thead>
                    <tr>
                        <th style="width:45%">Item</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>
                                <div class="beer-info">
                                    @if($order->beer)
                                        <img class="beer-image" src="{{ public_path('storage/' . $order->beer->image) }}"
                                            alt="{{ $order->beer->name }}">
                                        <div>
                                            <div class="beer-name">{{ $order->beer->name }}</div>
                                            <div class="beer-description">
                                                {{ $order->beer->description ?? 'Premium craft beer' }}
                                            </div>
                                        </div>
                                    @else
                                        <div class="w-12 h-12 rounded bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-beer text-gray-500"></i>
                                        </div>
                                        <div>
                                            <div class="beer-name">Unknown Beer</div>
                                            <div class="beer-description">Beer information not available</div>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $order->quantity }}</td>
                            <td>${{ number_format($order->beer->price ?? 0, 2) }}</td>
                            <td>${{ number_format($order->total_price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Totals -->
            <div class="total-section">
                <div class="total-row"><span>Total Items:</span> <span>{{ $totalItems }}</span></div>
                <div class="total-row"><span>Subtotal:</span> <span>${{ number_format($totalAmount, 2) }}</span></div>
                <div class="total-row"><span>Tax:</span> <span>$0.00</span></div>
                <div class="total-row"><span>Shipping:</span> <span>$0.00</span></div>
                <div class="total-row grand-total"><span>Grand Total:</span>
                    <span>${{ number_format($totalAmount, 2) }}</span>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                Thank you for choosing peaksip! <br>
                support@peaksip.com | Computer-generated invoice
            </div>
        </div>
    </div>
</body>

</html>
