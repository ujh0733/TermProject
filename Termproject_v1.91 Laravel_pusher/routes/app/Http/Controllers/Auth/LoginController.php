<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = 'closeLoginPage';
    protected function authenticated(Request $request, $user){
        $nowIP = $_SERVER['REMOTE_ADDR'];
        if($user->user_ip != '' && $user->user_ip != $nowIP)
            return redirect('login_page')->with('alert', '이미 로그인 중인 아이디입니다.');
     
        $user->user_ip = $nowIP;
        $user->save();
        
        if($request->board_num)
            return redirect('board_view?board_num='.$request->board_num)->with('alert', '로그인 성공!');
        else
            return redirect('closeLoginPage');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        $this->middleware('guest')->except('logout');
    }

    

    public function username(){
        return 'user_id';
    }

}
