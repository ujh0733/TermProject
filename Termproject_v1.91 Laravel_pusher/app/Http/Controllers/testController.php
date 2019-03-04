<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testController extends Controller
{
    public function pusherTest(Request $request){
    	return view('pusherTest');
    }

    public function pusherHome(Request $request){
    	return view('pusherHome');
    }

    public function pusherServer(Request $request){
    	return view('pusherServer');
    }

    public function pusherAjaxTest(Request $request){
        if($request->ajax()){
            $num = $request->num;
            $id = $request->id;

            return view('pusherServer')->with('num', $num)
                                       ->with('id', $id);
        }else{
            return 'Server Errors....';
        }
    }
}