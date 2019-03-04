<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth; 
use App\Ipmanagement;

class IpCheck
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
        $user_ip = $_SERVER['REMOTE_ADDR'];
        if(Ipmanagement::where('ip_address', $user_ip)->first()){
            Auth::logout();
            return redirect('banFailLogin');
        }
        return $next($request);
    }
}
?>