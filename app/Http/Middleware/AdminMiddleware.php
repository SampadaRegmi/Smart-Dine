<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user != null) {
            if ($user->role == "admin") {
                return $next($request);
            } else {
                // Redirect to login or show a custom error page
                return redirect()->route('login');
            }
        }

        // Handle the case where $user is null
        return redirect()->route('login');
    }
}
