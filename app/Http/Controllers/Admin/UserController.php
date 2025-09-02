<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%");
            });
        }

        // Role filter
        if ($request->has('role') && $request->role) {
            $query->where('role', $request->role);
        }

        // Status filter (active/inactive based on last login)
        if ($request->has('status') && $request->status) {
            if ($request->status === 'active') {
                $query->whereNotNull('last_login_at');
            } elseif ($request->status === 'inactive') {
                $query->whereNull('last_login_at');
            }
        }

        $users = $query->withCount('orders')
                      ->withSum('orders', 'total_price')
                      ->latest()
                      ->paginate(15);

        return view('frontend.admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['orders' => function($query) {
            $query->latest()->take(10);
        }]);

        $stats = [
            'total_orders' => $user->orders()->count(),
            'total_spent' => $user->orders()->sum('total_price'),
            'avg_order_value' => $user->orders()->avg('total_price'),
            'last_order_date' => $user->orders()->latest()->first()?->created_at,
            'messages_count' => $user->messages()->count(),
        ];

        return view('frontend.admin.users.show', compact('user', 'stats'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin'
        ]);

        $user->update(['role' => $request->role]);

        return response()->json([
            'success' => true,
            'message' => "User role updated to {$request->role} successfully!"
        ]);
    }

    public function destroy(User $user)
    {
        // Prevent admin from deleting themselves
        if ($user->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot delete your own account!'
            ], 400);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully!'
        ]);
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        $userIds = $request->user_ids;
        
        // Prevent admin from deleting themselves
        if (in_array(auth()->id(), $userIds)) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot delete your own account!'
            ], 400);
        }

        User::whereIn('id', $userIds)->delete();

        return response()->json([
            'success' => true,
            'message' => count($userIds) . ' users deleted successfully!'
        ]);
    }
}
