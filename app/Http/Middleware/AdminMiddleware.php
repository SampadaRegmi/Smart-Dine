<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the current user is authenticated
        if (Auth::check()) {
            // Check the role of the authenticated user
            if (Auth::user()->role === 'admin') {
                // If the user is an admin, allow access to the requested route
                return $next($request);
            } else {
                // If the user is not an admin, redirect them to the home page
                return redirect('/');
            }
        } else {
            // If the user is not authenticated, redirect them to the login page
            return redirect('/');
        }
    }
}
