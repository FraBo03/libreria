<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is logged in
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Check if the user has the 'admin' role
        $adminRoleId = 2; // Replace with your actual 'admin' role ID if different
        if (!$request->user()->roles()->where('role_id', $adminRoleId)->exists()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
