<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Order Status Updated</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif; color: #111827; }
        .container { max-width: 640px; margin: 0 auto; padding: 24px; }
        .badge { display: inline-block; padding: 6px 10px; border-radius: 9999px; color: #fff; font-weight: 700; font-size: 12px; }
        .card { border: 1px solid #e5e7eb; border-radius: 12px; padding: 16px; }
        .muted { color: #6b7280; font-size: 14px; }
        .total { font-weight: 700; }
        .item { display: flex; justify-content: space-between; padding: 6px 0; border-bottom: 1px solid #f3f4f6; }
    </style>
    </head>
<body>
    <div class="container">
        <h2 style="margin-bottom: 6px;">Your order {{ $groupCode }} was updated</h2>
        <p class="muted" style="margin-top:0;">New status: 
            <span class="badge" style="background:#2563eb;">{{ $newStatus }}</span>
        </p>

        <div class="card" style="margin-top:16px;">
            <p class="muted">Order summary</p>
            <div class="item"><span>Items</span><span>{{ $totalItems }}</span></div>
            <div class="item"><span>Total amount</span><span>${{ number_format($totalAmount, 2) }}</span></div>
        </div>

        <p class="muted" style="margin-top:16px;">If you have questions, reply to this email.</p>
        <p class="muted">— peaksip</p>
    </div>
</body>
</html>



