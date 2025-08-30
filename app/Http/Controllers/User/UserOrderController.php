<?php

namespace App\Http\Controllers\User;

use App\Models\Beer;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserOrderController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        // Get user's orders grouped by group_code with beer details
        $orders = $user->orders()
            ->with('beer')
            ->latest()
            ->get()
            ->groupBy('group_code');
        
        return view('frontend.users.orders.index', compact('orders'));
    }

    public function buybeer()
    {
        $beers = Beer::latest()->get();
        return view('frontend.users.buybeer.buybeer', compact('beers'));
    }
}
