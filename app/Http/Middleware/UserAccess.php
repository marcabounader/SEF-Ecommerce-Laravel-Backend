<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class UserAccess extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard=null)
    {
        if ($guard == "admins" && !Auth::guard($guard)->check()) {
            return redirect('/admin-console/admin-login.html');
        }
        if ($guard == "users" && !Auth::guard($guard)->check()) {
            return redirect('/login.html');
        }
        // if (Auth::guard($guard)->check()) {
        //     return redirect('/login.html');
        // }
    }
}