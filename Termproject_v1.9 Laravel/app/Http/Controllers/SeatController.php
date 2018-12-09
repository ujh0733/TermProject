<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\Seat;

class SeatController extends Controller
{
    public function makeSeat_page(Request $request){

		$board_num = $request->board_num;
		$board_info = Board::where('board_num', $board_num)->first();

		$openDay = $board_info->board_term_open;
		$closeDay = $board_info->board_term_close;

		return view('makeSeat_page')->with('board_num', $board_num)
									->with('board_info', $board_info)
									->with('openDay', $openDay)
									->with('closeDay', $closeDay);
    }

    public function makeSeat(Request $request){
		$board_num = $request->board_num;   

		$seat = $request->seat;

		$board_info = Board::where('board_num', $board_num)->first();

		$openDay = date($board_info->board_term_open);
		$closeDay = date($board_info->board_term_close);

		$leftDate = intval((strtotime($closeDay)-strtotime($openDay))/86400)+1;		//날짜 일수 계산

		$SeatInput = new Seat();

		$temp = $openDay;
		for($i = 0; $i < $leftDate; $i++){
			$SeatInput->createSeat($board_num, $seat, $temp);
			$temp = date("Y-m-d", strtotime($temp. "+1 days"));
		}

		return redirect('board_view?board_num='.$board_num)->with('alert', '좌석 지정이 완료되었습니다.');
    }

   public function remainSeat(Request $request){

		$board_num = $request->num;

		$info = Seat::where('board_num', $board_num)->get();

		return view('remainSeat')->with('board_num', $board_num)
								->with('info', $info);
    }
}
