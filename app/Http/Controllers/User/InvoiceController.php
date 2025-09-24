<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $invoices = Invoice::where('user_id', $user->id)
            ->latest('issued_at')
            ->paginate(15);
        return view('frontend.users.invoices.index', compact('invoices'));
    }

    public function show(Invoice $invoice)
    {
        $this->authorizeInvoice($invoice);
        $orders = $this->getInvoiceOrders($invoice);
        return view('frontend.users.invoices.show', compact('invoice', 'orders'));
    }

    public function download(Invoice $invoice)
    {
        $this->authorizeInvoice($invoice);
        $orders = $this->getInvoiceOrders($invoice);
        $pdf = Pdf::loadView('frontend.users.invoices.pdf', compact('invoice', 'orders'));
        $filename = 'invoice-' . Str::slug($invoice->invoice_number) . '.pdf';
        return $pdf->download($filename);
    }

    public function downloadMonthly(Request $request)
    {
        $user = $request->user();
        $month = $request->query('month'); // format YYYY-MM
        if (!$month) {
            abort(404);
        }
        [$year, $m] = explode('-', $month);
        $start = now()->setDate((int)$year, (int)$m, 1)->startOfMonth();
        $end = (clone $start)->endOfMonth();

        $orders = Order::where('user_id', $user->id)
            ->whereBetween('created_at', [$start, $end])
            ->with('beer')
            ->orderBy('group_code')
            ->get();

        $summary = [
            'subtotal' => $orders->sum('total_price'),
            'tax' => 0,
            'discount' => 0,
        ];
        $summary['total'] = $summary['subtotal'] + $summary['tax'] - $summary['discount'];

        $invoice = new Invoice([
            'user_id' => $user->id,
            'invoice_number' => 'MONTHLY-' . $start->format('Ymd') . '-' . $user->id,
            'subtotal' => $summary['subtotal'],
            'tax' => $summary['tax'],
            'discount' => $summary['discount'],
            'total' => $summary['total'],
            'billing_name' => $user->name,
            'billing_email' => $user->email,
            'issued_at' => now(),
            'period_start' => $start,
            'period_end' => $end,
            'type' => 'monthly',
        ]);

        $pdf = Pdf::loadView('frontend.users.invoices.pdf-monthly', [
            'invoice' => $invoice,
            'orders' => $orders,
            'monthLabel' => $start->format('F Y'),
        ]);
        $filename = 'invoice-monthly-' . $start->format('Y-m') . '.pdf';
        return $pdf->download($filename);
    }

    protected function authorizeInvoice(Invoice $invoice): void
    {
        if (auth()->id() !== $invoice->user_id) {
            abort(403);
        }
    }

    protected function getInvoiceOrders(Invoice $invoice)
    {
        if ($invoice->type === 'single' && $invoice->order_group_code) {
            return Order::where('user_id', $invoice->user_id)
                ->where('group_code', $invoice->order_group_code)
                ->with('beer')
                ->get();
        }
        if ($invoice->type === 'monthly' && $invoice->period_start && $invoice->period_end) {
            return Order::where('user_id', $invoice->user_id)
                ->whereBetween('created_at', [$invoice->period_start, $invoice->period_end])
                ->with('beer')
                ->get();
        }
        return collect();
    }
}


