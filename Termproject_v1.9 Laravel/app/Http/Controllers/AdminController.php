<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Board;
use App\Ipmanagement;

class AdminController extends Controller
{
	public function __construct(){
        $this->middleware('admin');
    }

    public function adminPage(){
    	$userCnt = User::count();

    	$dt = new \DateTime("now", new \DateTimeZone("Asia/Seoul"));
		$now = $dt->format('Y-m-d');

    	$nowBoardCnt = Board::where('board_term_open', '<=', $now)
    						->where('board_term_close', '>=', $now)
    						->count();

    	$allBoardCnt = Board::count();

    	$boardList = Board::orderby('board_posted', 'desc')->get();

    	$memberList = User::paginate(5);

    	$ipList = Ipmanagement::paginate(5);

		return view('adminPage')->with('userCnt', $userCnt)
								->with('nowBoardCnt', $nowBoardCnt)
								->with('allBoardCnt', $allBoardCnt)
								->with('boardList', $boardList)
								->with('memberList', $memberList)
								->with('ipList', $ipList);
	}

    public function adminAjax(Request $request){
        if($request->ajax()){
            $genre = substr($request->genre, 0, 1);

            $sort = $request->sort;

            if($genre == 'A')
                $board = Board::orderby($sort, 'desc')->get();
            else
                $board = Board::where('board_genre', $genre)->orderby($sort, 'desc')->get();
            //$board = Board::where('board_genre', $genre)->get();
            return $board;
        }else{
            return 'Server Errors...';
        }
    }

    public function adminPostAjax(Request $request){
        if($request->ajax()){
            $type = $request->type;
            $ip = $request->ip;

            if($type == "ban"){
                $ipBan = new Ipmanagement();
                $ipBan->createBan($ip);

                $date = Ipmanagement::where('ip_address', $ip)->first()->ban_date;

                $response = array(
                    'ip' => $ip,
                    'date' => $date,
                );

                return response()->json($response);
            }

        }else{
            return 'Server Errors...';
        }
    }
}
