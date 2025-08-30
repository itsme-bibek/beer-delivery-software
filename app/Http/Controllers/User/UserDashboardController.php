<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Beer;
use App\Models\Order;
use Carbon\Carbon;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        // User's order statistics
        $totalOrders = $user->orders()->count();
        $totalSpent = $user->orders()->sum('total_price');
        
        // Recent orders grouped by group_code (last 5 groups)
        $recentOrders = $user->orders()
            ->with('beer')
            ->latest()
            ->get()
            ->groupBy('group_code')
            ->take(5);
        
        // This month's orders
        $monthlyOrders = $user->orders()
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
        
        $monthSpent = $user->orders()
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('total_price');
        
        // Favorite beer (most ordered)
        $favoriteBeer = $user->orders()
            ->select('beer_id', \DB::raw('count(*) as order_count'))
            ->with('beer')
            ->groupBy('beer_id')
            ->orderBy('order_count', 'desc')
            ->first();
        
        // Beer recommendations (exclude already ordered)
        $orderedBeerIds = $user->orders()->pluck('beer_id')->unique();
        $recommendations = Beer::whereNotIn('id', $orderedBeerIds)
            ->inRandomOrder()
            ->take(3)
            ->get();
        
        // If no recommendations, show random beers
        if ($recommendations->isEmpty()) {
            $recommendations = Beer::inRandomOrder()->take(3)->get();
        }
        
        // Orders by status
        $ordersByStatus = $user->orders()
            ->select('status', \DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
        
        // Last order date
        $lastOrder = $user->orders()->latest()->first();

        return view('frontend.users.users', compact(
            'user',
            'totalOrders',
            'totalSpent',
            'recentOrders',
            'monthlyOrders',
            'monthSpent',
            'favoriteBeer',
            'recommendations',
            'ordersByStatus',
            'lastOrder'
        ));
    }
}
