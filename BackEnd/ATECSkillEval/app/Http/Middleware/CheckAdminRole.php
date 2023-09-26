<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->roles->contains('name', 'admin')) {
            return $next($request);
        }

        return abort(403, 'Unauthorized');
    }
}
