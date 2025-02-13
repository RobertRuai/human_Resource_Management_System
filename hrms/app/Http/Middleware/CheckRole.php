<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        if (!$user || !$user->hasAnyRole($roles)) {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}
