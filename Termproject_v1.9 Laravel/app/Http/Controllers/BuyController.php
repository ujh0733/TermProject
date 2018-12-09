<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Board;
use App\Viewingclass;
use App\Seat;
use App\Purchase;
use Session;
use Route;

class BuyController extends Controller
{
	public function __construct(Request $request){
		Session::flash('board_num', $request->num);
        $this->middleware('auth');
    }

    public function buy_page(Request $request){
		$board_num = $request->num;

		$board = Board::where('board_num', $board_num)->first();

		$info = Seat::orderBy('board_day')->where('board_num', $board_num)->get();
		
		$arrSize = Seat::where('board_num', $board_num)->count();

		//$seats = isset($info[0]['board_seat'])?$info[0]['board_seat']:'';
		$seats = $info->first();

		$viewingClass = Viewingclass::where('viewingClass', $board->board_viewingClass)->first()->Class;

		if(!$seats && $board->board_writer == Auth::user()->user_id){
			return redirect('makeSeat_page?board_num='.$board_num)->with('alert', '좌석이 등록되어 있지 않습니다\n좌석등록 페이지로 이동합니다.');
		}else if(!$seats){
			return back()->with('alert', '등록된 좌석이 없어서 예매를 하지 못합니다.');
		}

		return view('buy_page')->with('board_num', $board_num)
								->with('board', $board)
    							->with('info', $info)
    							->with('arrSize', $arrSize)
    							->with('seats', $seats->board_seat)
    							->with('viewingClass', $viewingClass);
    }

    public function buy(Request $request){

		$user_id = Auth::user()->user_id;

		$board_num = $request->board_num;
		$board_date = $request->day;
		$seat = $request->seat;

		$cnt = sizeof($seat);			//구매한 티켓 갯수

		$modifySeat = $request->modifySeat;
		
		$purchase = new Purchase();
		for($i = 0; $i < $cnt; $i++){
			$purchase->buyTicket($user_id, $board_num, $seat[$i], $board_date);
		}
		$SEAT = new Seat();
		$SEAT->updateSeat($board_num, $modifySeat, $board_date);

		return redirect('/')->with('alert', '구매가 정상적으로 완료되었습니다.');
    }
}
?>