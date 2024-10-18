<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsCustomer
{
    public function handle(Request $request, Closure $next)
    {
        abort_if(!$request->user()->hasRole('customer'), 404);
        return $next($request);
    }
}