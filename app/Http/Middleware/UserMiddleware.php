<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
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
        if (Auth::user()) {
            if (!Gate::allows('check-route', \Route::current()->getName())) {
                return back()->with('authMessage', "You are unauthorized to perform this operation");
            }
            return $next($request);
        } else {
            return redirect()->route('homePage');
        }
    }
}
