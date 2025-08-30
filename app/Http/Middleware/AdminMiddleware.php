<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Check if user is authenticated
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Check if user has admin role
        if ($user->role !== 'admin') {
            return redirect()->route('user-home')->with('error', 'Access denied. Admin privileges required.');
        }

        return $next($request);
    }
}
