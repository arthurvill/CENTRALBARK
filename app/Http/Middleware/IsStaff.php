<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsStaff
{
    public function handle(Request $request, Closure $next)
    {
        abort_if(!$request->user()->hasRole('staff'), 404);
        return $next($request);
    }
}