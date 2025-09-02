<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderStatusUpdated;
use App\Mail\OrderCancelled;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'beer')
            ->latest()
            ->get()
            ->groupBy('group_code');
        
        return view('frontend.admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Pending,Processing,Shipped,Delivered,Cancelled',
        ]);

        $order->update(['status' => $request->status]);

        // Notify user via email for single order update
        $user = $order->user;
        if ($user && $user->email) {
            try {
                Mail::to($user->email)->send(new OrderStatusUpdated(
                    $order->group_code,
                    $request->status,
                    collect([$order])
                ));
                Log::info('Order status email sent', [
                    'group_code' => $order->group_code,
                    'status' => $request->status,
                    'to' => $user->email,
                ]);
            } catch (\Throwable $e) {
                Log::error('Failed to send order status email', [
                    'error' => $e->getMessage(),
                    'group_code' => $order->group_code,
                    'to' => $user->email,
                ]);
            }
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated!');
    }

    public function updateGroupStatus(Request $request, $groupCode)
    {
        $request->validate([
            'status' => 'required|in:Pending,Processing,Shipped,Delivered,Cancelled',
        ]);

        $orders = Order::where('group_code', $groupCode)->with('user')->get();
        
        foreach ($orders as $order) {
            $order->update(['status' => $request->status]);
        }

        // Send a single email to the group's user (assumes same user per group)
        $first = $orders->first();
        if ($first && $first->user && $first->user->email) {
            try {
                Mail::to($first->user->email)->send(new OrderStatusUpdated(
                    $groupCode,
                    $request->status,
                    $orders
                ));
                Log::info('Group order status email sent', [
                    'group_code' => $groupCode,
                    'status' => $request->status,
                    'to' => $first->user->email,
                ]);
            } catch (\Throwable $e) {
                Log::error('Failed to send group order status email', [
                    'error' => $e->getMessage(),
                    'group_code' => $groupCode,
                    'to' => $first->user->email,
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'All orders in group updated successfully!'
        ]);
    }

    public function destroy(Request $request, Order $order)
    {
        $order->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted!');
    }

    public function deleteOrderGroup(Request $request, $groupCode)
    {
        $orders = Order::where('group_code', $groupCode)->get();
        
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
            $orders = Order::where('group_code', $groupCode)->get();
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

    public function cancelOrderGroup(Request $request, $groupCode)
    {
        $orders = Order::where('group_code', $groupCode)->with('user')->get();
        
        if ($orders->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Order group not found'
            ], 404);
        }

        // Update all orders in the group to cancelled status
        foreach ($orders as $order) {
            $order->update(['status' => 'Cancelled']);
        }

        // Send cancellation email to the user
        $first = $orders->first();
        if ($first && $first->user && $first->user->email) {
            try {
                Mail::to($first->user->email)->send(new OrderCancelled(
                    $groupCode,
                    $orders
                ));
                Log::info('Order cancellation email sent', [
                    'group_code' => $groupCode,
                    'to' => $first->user->email,
                ]);
            } catch (\Throwable $e) {
                Log::error('Failed to send order cancellation email', [
                    'error' => $e->getMessage(),
                    'group_code' => $groupCode,
                    'to' => $first->user->email,
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Order group cancelled successfully! Cancellation email sent to customer.'
        ]);
    }
}
