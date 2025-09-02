<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Order Cancelled</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif; color: #111827; }
        .container { max-width: 640px; margin: 0 auto; padding: 24px; }
        .badge { display: inline-block; padding: 6px 10px; border-radius: 9999px; color: #fff; font-weight: 700; font-size: 12px; }
        .card { border: 1px solid #e5e7eb; border-radius: 12px; padding: 16px; }
        .muted { color: #6b7280; font-size: 14px; }
        .total { font-weight: 700; }
        .item { display: flex; justify-content: space-between; padding: 6px 0; border-bottom: 1px solid #f3f4f6; }
        .cancelled-badge { background: #dc2626 !important; }
        .header { background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%); color: white; padding: 20px; border-radius: 12px; margin-bottom: 20px; }
    </style>
    </head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="margin: 0; color: white;">Order Cancelled</h2>
            <p style="margin: 8px 0 0 0; opacity: 0.9;">We're sorry to inform you that your order has been cancelled</p>
        </div>

        <div class="card">
            <h3 style="margin-top: 0;">Order Details</h3>
            <p class="muted">Order ID: <strong>{{ $groupCode }}</strong></p>
            <p class="muted">Cancelled on: <strong>{{ now()->format('M d, Y H:i') }}</strong></p>
            
            <div style="margin: 16px 0;">
                <span class="badge cancelled-badge">CANCELLED</span>
            </div>

            <div style="margin-top: 16px;">
                <p class="muted">Order summary</p>
                <div class="item"><span>Items</span><span>{{ $totalItems }}</span></div>
                <div class="item"><span>Total amount</span><span>${{ number_format($totalAmount, 2) }}</span></div>
            </div>
        </div>

        <div class="card" style="margin-top: 16px; background: #fef2f2; border-color: #fecaca;">
            <h4 style="margin-top: 0; color: #dc2626;">What happens next?</h4>
            <ul style="color: #6b7280; margin: 8px 0;">
                <li>If you paid by card, your refund will be processed within 3-5 business days</li>
                <li>You can place a new order anytime through our website</li>
                <li>For any questions, please contact our support team</li>
            </ul>
        </div>

        <p class="muted" style="margin-top: 16px;">If you have any questions about this cancellation, please reply to this email or contact our support team.</p>
        <p class="muted">— peaksip Team</p>
    </div>
</body>
</html>
