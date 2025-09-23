<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureLlboVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return $next($request);
        }

        // Allow admins through
        if (method_exists($user, 'isAdmin') && $user->isAdmin()) {
            return $next($request);
        }

        // Allow LLBO pages themselves, waiting page, logout, profile
        if (
            $request->routeIs('user.llbo-verification.*') ||
            $request->routeIs('user.waiting-verification') ||
            $request->routeIs('logout') ||
            $request->routeIs('user.profile*')
        ) {
            return $next($request);
        }

        // Ensure fresh relation
        $user->load('llboVerification');
        $verification = $user->llboVerification;

        // If no verification or not verified, redirect to waiting page
        // (We are not blocking on expiry here to avoid false negatives.)
        if (!$verification || $verification->status !== 'verified') {
            return redirect()->route('user.waiting-verification');
        }

        return $next($request);
    }
}
