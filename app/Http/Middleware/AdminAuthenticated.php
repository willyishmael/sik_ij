<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            
            // if user is not admin take him to his dashboard
            if ( Auth::user()->User::isUser() ) {
                return redirect(route('user_dashboard'));
           }

           // allow admin to proceed with request
           else if ( Auth::user()->User::isAdmin() ) {
                return $next($request);
           }
            
        }

        abort(404);  // for other user throw 404 error
    }
}
