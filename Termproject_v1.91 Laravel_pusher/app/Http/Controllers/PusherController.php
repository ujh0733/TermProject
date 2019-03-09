<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seat;

class PusherController extends Controller
{   
    public function pusherServer(Request $request){
    	return view('pusherServer');
    }

    public function pusherAjax(Request $request){
        if($request->ajax()){
            $num = $request->num;
            $id = $request->id;
            $day = $request->day;
            $data = $request->data;

            $seat = new Seat();
            $seat->updateSeat($num, $data, $day);

            return view('pusherServer')->with('num', $num)
                                       ->with('id', $id);
        }else{
            return 'Server Errors....';
        }
    }

}
