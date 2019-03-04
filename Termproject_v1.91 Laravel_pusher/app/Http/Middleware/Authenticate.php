<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Session;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {   
        if (! $request->expectsJson()) {
            Session::flash('alert', '로그인해야 구매가 가능합니다.');
            Session::reflash('board_num', Session::get("board_num"));
            return route('login_page');
        }
    }
}

?>
