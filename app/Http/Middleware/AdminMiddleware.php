<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Gate;
use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Gate::allows('check-route', \Route::current()->getName())) {
            return back()->with('authMessage', "You are unauthorized to perform this operation");
        }
        if (isAdmin()) {
            return $next($request);
        } else {
            return redirect('users/dashboard');
        }
    }
}
