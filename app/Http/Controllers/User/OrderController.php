<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Beer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $request->user()->orders()
            ->with('beer')
            ->latest()
            ->get()
            ->groupBy('group_code');

        return view('frontend.users.orders.index', compact('orders'));
    }

    public function buybeer()
    {
        return view('frontend.users.buybeer.buybeer');
    }

    public function store(Request $request)
    {
        $request->validate([
            'beer_id'  => 'required|exists:beers,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $beer = Beer::findOrFail($request->beer_id);

        $order = Order::create([
            'user_id'     => $request->user()->id,
            'beer_id'     => $beer->id,
            'quantity'    => $request->quantity,
            'total_price' => $beer->price * $request->quantity,
            'status'      => 'Pending',
            'image'       => $beer->image ?? 'default-beer-image.jpg',
            'group_code'  => 'ORD-' . Str::random(8),
            'payment_method' => 'cod',
        ]);

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }

    public function bulkStore(Request $request)
    {
        $request->validate([
            'items'                => 'required|array|min:1',
            'items.*.beer_id'      => 'required|integer|exists:beers,id',
            'items.*.quantity'     => 'required|integer|min:1',
            'payment_method'       => 'required|in:cod,card',
        ]);

        $groupCode = 'ORD-' . Str::random(8);

        DB::transaction(function () use ($request, $groupCode) {
            foreach ($request->items as $item) {
                $beer = Beer::findOrFail($item['beer_id']);
                Order::create([
                    'user_id'     => $request->user()->id,
                    'beer_id'     => $beer->id,
                    'quantity'    => (int) $item['quantity'],
                    'total_price' => $beer->price * (int) $item['quantity'],
                    'status'      => 'Pending',
                    'image'       => $beer->image ?? 'default-beer-image.jpg',
                    'group_code'  => $groupCode,
                    'payment_method' => $request->payment_method,
                ]);
            }
        });

        return response()->json(['success' => true, 'group_code' => $groupCode]);
    }

    public function show(Order $order, Request $request)
    {
        if ($order->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized access.');
        }

        return view('frontend.users.orders.show', compact('order'));
    }

    public function downloadInvoice($groupCode, Request $request)
    {
        $orders = Order::where('group_code', $groupCode)
            ->where('user_id', $request->user()->id)
            ->with(['beer', 'user'])
            ->get();

        if ($orders->isEmpty()) {
            abort(404, 'Order group not found.');
        }

        $totalAmount = $orders->sum('total_price');
        $totalItems = $orders->sum('quantity');
        $orderDate = $orders->first()->created_at;
        $user = $orders->first()->user;
        $paymentMethod = $orders->first()->payment_method;

        $pdf = Pdf::loadView('frontend.users.orders.invoice', compact(
            'orders',
            'totalAmount',
            'totalItems',
            'orderDate',
            'user',
            'paymentMethod',
            'groupCode'
        ));

        return $pdf->download("invoice-{$groupCode}.pdf");
    }

    public function printInvoice($groupCode, Request $request)
    {
        $orders = Order::where('group_code', $groupCode)
            ->where('user_id', $request->user()->id)
            ->with(['beer', 'user'])
            ->get();

        if ($orders->isEmpty()) {
            abort(404, 'Order group not found.');
        }

        $totalAmount = $orders->sum('total_price');
        $totalItems = $orders->sum('quantity');
        $orderDate = $orders->first()->created_at;
        $user = $orders->first()->user;
        $paymentMethod = $orders->first()->payment_method;

        return view('frontend.users.orders.invoice-print', compact(
            'orders',
            'totalAmount',
            'totalItems',
            'orderDate',
            'user',
            'paymentMethod',
            'groupCode'
        ));
    }
}
