<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthCheck
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
        $userAuth = Auth::user()->user_auth;
        if(!($userAuth == 'TOP' || $userAuth == 'A')){
            return back()->with('alert', '자네는 일반유저구만?');
        }
        return $next($request);
    }
}
