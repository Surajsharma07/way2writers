<?php

namespace App\Http\Middleware;

use App\Models\Companie;
use Closure;
use Session;
use Auth;

class UserViewAuth
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
        if (!Auth::check()) {
            return redirect()->route('frontend.sign-in');
        }
        return $next($request);
    }
}
