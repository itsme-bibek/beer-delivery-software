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
            'delivery_note' => 'nullable|string|max:1000',
            'delivery_slot' => 'nullable|string|max:50',
            'is_recurring' => 'nullable|boolean',
            'recurring_interval' => 'nullable|string|in:weekly,biweekly,monthly'
        ]);

        $beer = Beer::findOrFail($request->beer_id);

        // Check if beer is available and has enough stock
        if (!$beer->isAvailable()) {
            return redirect()->back()->with('error', 'This beer is currently unavailable.');
        }

        if ($beer->stock < $request->quantity) {
            return redirect()->back()->with('error', "Only {$beer->stock} bottles of {$beer->name} are available in stock.");
        }

        DB::transaction(function () use ($request, $beer) {
            // Create the order
            Order::create([
                'user_id'     => $request->user()->id,
                'beer_id'     => $beer->id,
                'quantity'    => $request->quantity,
                'total_price' => $beer->price * $request->quantity,
                'status'      => 'Pending',
                'image'       => $beer->image ?? 'default-beer-image.jpg',
                'group_code'  => 'ORD-' . Str::random(8),
                'payment_method' => 'cod',
                'delivery_note' => $request->delivery_note,
                'delivery_slot' => $request->delivery_slot,
                'is_recurring' => (bool) $request->boolean('is_recurring'),
                'recurring_interval' => $request->recurring_interval,
            ]);

            // Reduce beer stock
            $beer->decrement('stock', $request->quantity);
        });

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }

    public function bulkStore(Request $request)
    {
        $request->validate([
            'items'                => 'required|array|min:1',
            'items.*.beer_id'      => 'required|integer|exists:beers,id',
            'items.*.quantity'     => 'required|integer|min:1',
            'payment_method'       => 'required|in:cod,card',
            'delivery_note'        => 'nullable|string|max:1000',
            'delivery_slot'        => 'nullable|string|max:50',
            'is_recurring'         => 'nullable|boolean',
            'recurring_interval'   => 'nullable|string|in:weekly,biweekly,monthly'
        ]);

        // First, validate all items have enough stock
        $validationErrors = [];
        $beers = [];
        
        foreach ($request->items as $item) {
            $beer = Beer::findOrFail($item['beer_id']);
            $beers[$item['beer_id']] = $beer;
            
            if (!$beer->isAvailable()) {
                $validationErrors[] = "{$beer->name} is currently unavailable.";
            } elseif ($beer->stock < $item['quantity']) {
                $validationErrors[] = "Only {$beer->stock} bottles of {$beer->name} are available in stock.";
            }
        }

        if (!empty($validationErrors)) {
            return response()->json([
                'success' => false, 
                'message' => implode(' ', $validationErrors)
            ], 400);
        }

        $groupCode = 'ORD-' . Str::random(8);

        DB::transaction(function () use ($request, $groupCode, $beers) {
            foreach ($request->items as $item) {
                $beer = $beers[$item['beer_id']];
                
                Order::create([
                    'user_id'     => $request->user()->id,
                    'beer_id'     => $beer->id,
                    'quantity'    => (int) $item['quantity'],
                    'total_price' => $beer->price * (int) $item['quantity'],
                    'status'      => 'Pending',
                    'image'       => $beer->image ?? 'default-beer-image.jpg',
                    'group_code'  => $groupCode,
                    'payment_method' => $request->payment_method,
                    'delivery_note' => $request->delivery_note,
                    'delivery_slot' => $request->delivery_slot,
                    'is_recurring' => (bool) $request->boolean('is_recurring'),
                    'recurring_interval' => $request->recurring_interval,
                ]);

                // Reduce beer stock
                $beer->decrement('stock', (int) $item['quantity']);
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

    public function reorder($groupCode, Request $request)
    {
        // Get the original order group
        $originalOrders = Order::where('group_code', $groupCode)
            ->where('user_id', $request->user()->id)
            ->with('beer')
            ->get();

        if ($originalOrders->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Order not found.'], 404);
        }

        // Check if all beers are still available and have enough stock
        $unavailableBeers = [];
        foreach ($originalOrders as $order) {
            if (!$order->beer || !$order->beer->isAvailable()) {
                $unavailableBeers[] = $order->beer->name ?? 'Unknown Beer';
            } elseif ($order->beer->stock < $order->quantity) {
                $unavailableBeers[] = "{$order->beer->name} (only {$order->beer->stock} available, need {$order->quantity})";
            }
        }

        if (!empty($unavailableBeers)) {
            return response()->json([
                'success' => false, 
                'message' => 'Some items are no longer available: ' . implode(', ', $unavailableBeers)
            ], 400);
        }

        // Create new order group
        $newGroupCode = 'ORD-' . Str::random(8);
        $paymentMethod = $originalOrders->first()->payment_method;

        DB::transaction(function () use ($originalOrders, $newGroupCode, $paymentMethod, $request) {
            foreach ($originalOrders as $originalOrder) {
                Order::create([
                    'user_id'     => $request->user()->id,
                    'beer_id'     => $originalOrder->beer_id,
                    'quantity'    => $originalOrder->quantity,
                    'total_price' => $originalOrder->total_price,
                    'status'      => 'Pending',
                    'image'       => $originalOrder->image,
                    'group_code'  => $newGroupCode,
                    'payment_method' => $paymentMethod,
                ]);

                // Reduce beer stock
                $originalOrder->beer->decrement('stock', $originalOrder->quantity);
            }
        });

        return response()->json([
            'success' => true, 
            'message' => 'Order reordered successfully!',
            'group_code' => $newGroupCode
        ]);
    }

    public function getBeerStock(Beer $beer)
    {
        return response()->json([
            'id' => $beer->id,
            'name' => $beer->name,
            'stock' => $beer->stock,
            'is_available' => $beer->isAvailable(),
            'availability_status' => $beer->getAvailabilityStatus()
        ]);
    }

    public function deleteOrderGroup(Request $request, $groupCode)
    {
        $orders = Order::where('group_code', $groupCode)
            ->where('user_id', $request->user()->id)
            ->get();
        
        if ($orders->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Order group not found'
            ], 404);
        }

        // Delete all orders in the group
        foreach ($orders as $order) {
            $order->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Order group deleted successfully!'
        ]);
    }

    public function bulkDeleteOrders(Request $request)
    {
        $request->validate([
            'groupCodes' => 'required|array',
            'groupCodes.*' => 'string'
        ]);

        $groupCodes = $request->groupCodes;
        $deletedCount = 0;

        foreach ($groupCodes as $groupCode) {
            $orders = Order::where('group_code', $groupCode)
                ->where('user_id', $request->user()->id)
                ->get();
            
            if ($orders->isNotEmpty()) {
                foreach ($orders as $order) {
                    $order->delete();
                }
                $deletedCount++;
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Successfully deleted {$deletedCount} order group(s)!"
        ]);
    }
}
