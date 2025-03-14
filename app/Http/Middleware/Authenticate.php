<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        if ($request->is('admin') || $request->is('admin/*')) {
            return route('admin.login');
        }

        if ($request->is('supplier') || $request->is('supplier/*')) {
            return route('supplier.login');
        }

        if (! $request->expectsJson()) {
            return route('admin.login');
        }
    }
}
