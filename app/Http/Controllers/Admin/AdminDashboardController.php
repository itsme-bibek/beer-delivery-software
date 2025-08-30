<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Beer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Basic counts
        $totalOrders = Order::count();
        $totalUsers = User::count();
        $totalBeers = Beer::count();
        $totalSales = Order::sum('total_price');

        // Today's statistics
        $todayOrders = Order::whereDate('created_at', Carbon::today())->count();
        $todaySales = Order::whereDate('created_at', Carbon::today())->sum('total_price');
        
        // This month's statistics
        $monthOrders = Order::whereMonth('created_at', Carbon::now()->month)->count();
        $monthSales = Order::whereMonth('created_at', Carbon::now()->month)->sum('total_price');

        // Recent orders grouped by group_code with user and beer details
        $recentOrders = Order::with(['user', 'beer'])
            ->latest()
            ->get()
            ->groupBy('group_code')
            ->take(10);

        // Popular beers (by order count)
        $popularBeers = Order::select('beer_id', DB::raw('count(*) as order_count'))
            ->with('beer')
            ->groupBy('beer_id')
            ->orderBy('order_count', 'desc')
            ->take(5)
            ->get()
            ->map(function ($item) {
                return (object) [
                    'name' => $item->beer->name ?? 'Unknown Beer',
                    'price' => $item->beer->price ?? 0,
                    'order_count' => $item->order_count
                ];
            });

        // Orders by status
        $ordersByStatus = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Recent users
        $recentUsers = User::latest()->take(5)->get();

        // Sales chart data (last 7 days)
        $salesData = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_price) as total'))
            ->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('frontend.admin.admin', compact(
            'totalOrders',
            'totalUsers', 
            'totalBeers',
            'totalSales',
            'todayOrders',
            'todaySales',
            'monthOrders',
            'monthSales',
            'recentOrders',
            'popularBeers',
            'ordersByStatus',
            'recentUsers',
            'salesData'
        ));
    }
}
