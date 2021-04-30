<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\User;

class AdminAuthenticate {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::check()) {
            $user = User::find(Auth::id());
            if ($user->role == 0) {
                return redirect('/');
            }
            return $next($request);
        } else {
            return redirect('/');
        }
    }

}
