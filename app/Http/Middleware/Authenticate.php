<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        if (! $request->expectsJson()) {
        if ($request->is('student/*')) {
            return route('student.login');
        }
        
        if ($request->is('registrar/*')) {
            return route('registrar.login');
        }

        return route('login');
    }
    }
}
