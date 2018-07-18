<?php

namespace App\Http\Middleware;

use App\UserSubscription;
use Closure;

class PayableMiddleware
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
        if (auth()->check()) {
            // Only proceed if user has at least one subscription which is not paid for.
            $subscriptions = UserSubscription::where([['user_id', auth()->user()->id],
                ['payment_status', 0]])->first();
            if ($subscriptions) {
                return $next($request);
            } else {
                return redirect()->route('payment.packages');
            }
        } else {
            return redirect()->route('login');
        }
    }
}
