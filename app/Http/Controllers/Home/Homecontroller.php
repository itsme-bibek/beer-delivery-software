<?php

namespace App\Http\Controllers\Home;

use App\Models\User;
use App\Models\Beer;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class Homecontroller extends Controller
{

    public function userhome()
    {
        $user = User::find(auth()->id());

        // Guard in case of missing auth (should be protected by middleware)
        if (!$user) {
            return redirect()->route('login');
        }

        // User's order statistics
        $totalOrders = $user->orders()->count();
        $totalSpent = $user->orders()->sum('total_price');

        // Recent orders (last 5)
        $recentOrders = $user->orders()
            ->with('beer')
            ->latest()
            ->take(5)
            ->get();

        // This month's orders and spend
        $monthOrders = $user->orders()
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

        if ($recommendations->isEmpty()) {
            $recommendations = Beer::inRandomOrder()->take(3)->get();
        }

        // Orders by status
        $ordersByStatus = $user->orders()
            ->select('status', \DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        // Last order
        $lastOrder = $user->orders()->with('beer')->latest()->first();

        return view('frontend.users.users', compact(
            'user',
            'totalOrders',
            'totalSpent',
            'recentOrders',
            'monthOrders',
            'monthSpent',
            'favoriteBeer',
            'recommendations',
            'ordersByStatus',
            'lastOrder'
        ));
    }
}
