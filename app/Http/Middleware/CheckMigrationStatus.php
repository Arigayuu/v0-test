<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class CheckMigrationStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if carts table exists
        if ($request->is('cart*') && !Schema::hasTable('carts')) {
            return redirect()->route('home')->with('error', 'Cart functionality is currently unavailable. Please run migrations.');
        }

        return $next($request);
    }
}
