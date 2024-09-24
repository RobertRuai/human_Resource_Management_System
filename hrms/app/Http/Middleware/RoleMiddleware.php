<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Check if user is authenticated
         if (!Auth::check()) {
            return redirect('/login'); // Redirect to login if not authenticated
        }

        // Check if user has the required role
        $user = Auth::user();
        if ($user->role->name !== $role) {
            return redirect('/'); // Redirect to home if unauthorized
        }
        
        return $next($request);
    }
}
