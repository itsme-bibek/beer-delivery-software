<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Beer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    /**
     * Get order status analytics for charts
     */
    public function getOrderStatusAnalytics(Request $request)
    {
        $user = $request->user();
        
        // Get orders by status for the authenticated user
        $ordersByStatus = $user->orders()
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Ensure all statuses are represented
        $allStatuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];
        $statusData = [];
        $statusColors = [
            'Pending' => '#fbbf24',
            'Processing' => '#3b82f6', 
            'Shipped' => '#8b5cf6',
            'Delivered' => '#10b981',
            'Cancelled' => '#ef4444'
        ];

        foreach ($allStatuses as $status) {
            $statusData[] = [
                'label' => $status,
                'count' => $ordersByStatus[$status] ?? 0,
                'color' => $statusColors[$status]
            ];
        }

        return response()->json([
            'labels' => array_column($statusData, 'label'),
            'data' => array_column($statusData, 'count'),
            'colors' => array_column($statusData, 'color')
        ]);
    }

    /**
     * Get monthly order trends for the user
     */
    public function getMonthlyTrends(Request $request)
    {
        $user = $request->user();
        
        // Get last 6 months of data
        $months = [];
        $orderCounts = [];
        $orderAmounts = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('M');
            $months[] = $monthName;
            
            $orders = $user->orders()
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month);
                
            $orderCounts[] = $orders->count();
            $orderAmounts[] = $orders->sum('total_price');
        }

        return response()->json([
            'months' => $months,
            'orderCounts' => $orderCounts,
            'orderAmounts' => $orderAmounts
        ]);
    }

    /**
     * Get beer popularity analytics for the user
     */
    public function getBeerPopularity(Request $request)
    {
        $user = $request->user();
        
        $beerStats = $user->orders()
            ->select('beer_id', 'beers.name', DB::raw('count(*) as order_count'), DB::raw('sum(quantity) as total_quantity'))
            ->join('beers', 'orders.beer_id', '=', 'beers.id')
            ->groupBy('beer_id', 'beers.name')
            ->orderBy('order_count', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'labels' => $beerStats->pluck('name')->toArray(),
            'data' => $beerStats->pluck('order_count')->toArray(),
            'quantities' => $beerStats->pluck('total_quantity')->toArray()
        ]);
    }

    /**
     * Get admin analytics (all orders)
     */
    public function getAdminAnalytics(Request $request)
    {
        // Get all orders by status
        $ordersByStatus = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Get monthly trends for all orders
        $months = [];
        $orderCounts = [];
        $orderAmounts = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('M');
            $months[] = $monthName;
            
            $orders = Order::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month);
                
            $orderCounts[] = $orders->count();
            $orderAmounts[] = $orders->sum('total_price');
        }

        // Get popular beers across all users
        $popularBeers = Order::select('beer_id', 'beers.name', DB::raw('count(*) as order_count'), DB::raw('sum(quantity) as total_quantity'))
            ->join('beers', 'orders.beer_id', '=', 'beers.id')
            ->groupBy('beer_id', 'beers.name')
            ->orderBy('order_count', 'desc')
            ->limit(5)
            ->get();

        // Ensure all statuses are represented
        $allStatuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];
        $statusData = [];
        $statusColors = [
            'Pending' => '#fbbf24',
            'Processing' => '#3b82f6', 
            'Shipped' => '#8b5cf6',
            'Delivered' => '#10b981',
            'Cancelled' => '#ef4444'
        ];

        foreach ($allStatuses as $status) {
            $statusData[] = [
                'label' => $status,
                'count' => $ordersByStatus[$status] ?? 0,
                'color' => $statusColors[$status]
            ];
        }

        return response()->json([
            'statusAnalytics' => [
                'labels' => array_column($statusData, 'label'),
                'data' => array_column($statusData, 'count'),
                'colors' => array_column($statusData, 'color')
            ],
            'monthlyTrends' => [
                'months' => $months,
                'orderCounts' => $orderCounts,
                'orderAmounts' => $orderAmounts
            ],
            'popularBeers' => [
                'labels' => $popularBeers->pluck('name')->toArray(),
                'data' => $popularBeers->pluck('order_count')->toArray(),
                'quantities' => $popularBeers->pluck('total_quantity')->toArray()
            ]
        ]);
    }
}