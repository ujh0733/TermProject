<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use App\Board;
use App\Viewingclass;
use App\Genre;
use App\Comment;
use App\Theater;
use App\User;

class BoardController extends Controller
{	

    public function index(Request $request){

		$board_info = Board::orderBy('board_term_open', 'desc')->take(4)->get();
		$board_info_viewed = Board::orderBy('board_viewed', 'desc')->take(4)->get();

		return view('main_page')->with('board_info', $board_info)
								->with('board_info_viewed', $board_info_viewed);

    }

    public function board(Request $request){
		$board_info = Board::orderBy('board_num', 'desc')->paginate(5);

		$page = $request->page;

		$num = 2;
		$genre = '';

		$dt = new DateTime("now", new \DateTimeZone("Asia/Seoul"));
		$now = $dt->format('Y-m-d');

		return view('board_page')->with('board_info', $board_info)
								->with('page', $page)
								->with('genre', $genre)
								->with('num', $num)
								->with('now', $now);					
	}

	public function board_list(Request $request){
		$board_info = Board::orderBy('board_num', 'desc')->get();

		$page = $request->page;
		$genre = $request->genre;

		$pageGenre = Genre::where('board_genre', $genre)->first();
		$pageGenre = $pageGenre->Class;
		//$pageGenre = $pageGenre['Class'];		//둘다 됨


		if($genre){
			if($genre == 'M'){
		   		$num = 3;
			}else if($genre == 'C'){
			    $num = 4;
			}else if($genre == 'P'){
			    $num = 5;
			}else if($genre == 'E'){
			    $num = 6;
			}else if($genre == 'K'){
			    $num = 7;
			}
		}

		$start = 0;   //0번부터
		$getCol = 8;  //8개씩

		$numMsgs = Board::where('board_genre', $genre)->count();

		$msgs = Board::where('board_genre', $genre)->orderBy('board_num', 'desc')->skip($start)->take($getCol)->get();


		//현재 날짜와 공연 기간 맞춰서 예매중, 공연임박(2주), 공연중(기간안), 공연종료(기간후) 출력!
		$dt = new DateTime("now", new \DateTimeZone("Asia/Seoul"));
		$now = $dt->format('Y-m-d');

		$cnt = 1;

		return view('board_page')->with('page', $page)
								->with('genre', $genre)
								->with('pageGenre', $pageGenre)
								->with('numMsgs', $numMsgs)
								->with('msgs', $msgs)
								->with('cnt', $cnt)
								->with('num', $num)
								->with('now', $now);
	}

	public function view(Request $request){
		$board_num = $request->board_num;
		$page = $request->page;

		if(Auth::check()){
			$user_id = Auth::user()->user_id;
			$user_name = Auth::user()->user_name;
		}else{
			$user_id = 'guest';
			$user_name = 'guest';
		}

		$incres = new Board();
		$incres->increaseBoard($board_num);

		$board = Board::where('board_num', $board_num)->first();

		$board_title = $board->board_title;
		$board_context = $board->board_context;
		$board_viewingClass = $board->board_viewingClass;

		$viewingClass = Viewingclass::where('viewingClass', $board_viewingClass)->first();
		$viewingClass = $viewingClass->Class;

		$comment = Comment::where('board_num', $board_num)->orderby('comment_date', 'dest')->get();
		$commentCnt = Comment::where('board_num', $board_num)->count();

		return view('board_view')->with('user_id', $user_id)
								->with('board_num', $board_num)
								->with('page', $page)
								->with('board', $board)
								->with('board_title', $board_title)
								->with('board_context', $board_context)
								->with('viewingClass', $viewingClass)
								->with('comment', $comment)
								->with('commentCnt', $commentCnt)
								->with('user_name', $user_name);
	}

	public function write_page(){
		return view('write_page');
	}

	public function write(Request $request){
		$count = Board::count();

		$board_title = $request->title;
		$board_context = $request->context;

		$board_writer = $request->writer;
		$board_opener = $request->opener;

		$start_year = $request->start_year;
		$start_month = $request->start_month;
		$start_day = $request->start_day;
		$start_term = $start_year."-".$start_month."-".$start_day;

		$end_year = $request->end_year;
		$end_month = $request->end_month;
		$end_day = $request->end_day;
		$end_term = $end_year."-".$end_month."-".$end_day;

		$board_genre = $request->genre;
		$board_place = $request->place;
		$board_time = $request->time;
		$board_price = $request->price;
		$board_viewingClass = $request->viewingClass;

		$board_picture = "board_picture";

		$theater_lat = $request->theater_lat;
		$theater_lng = $request->theater_lng;

		if($board_title && $board_writer){
			$board = new Board();
			$theater = new Theater();
			//$board_picture = saveImg($board_picture);
			$board_picture = $board_picture;
			$board->createBoard($count+1, $board_title, $board_context, $board_writer, $board_opener, $start_term, $end_term, $board_place, $board_time, $board_viewingClass, $board_price, $board_genre, $board_picture);
			$theater->createLocation($count+1, $board_place, $theater_lat, $theater_lng);
			return redirect('board_page')->with('alert', '글쓰기가 완료되었습니다.');
		}else{
			return back()->with('alert', '해당 항목들을 모두 채워 주세요.');
		}
	}

	public function cart(Request $request){

		if(Auth::check())
			$user_id = Auth::user()->user_id;
		else
			$user_id = 'guest';


		$cookie_board = isset($_COOKIE[$user_id])?$_COOKIE[$user_id]:"";

		//로그인 중이면 로그인값으로 쿠키, 로그인중 아니면 게스트 값으로 쿠키 값 반환
		if($cookie_board){
			$cookie_board = explode(',', $cookie_board);
			$cart = Board::whereIn('board_num', $cookie_board)->get();
		}else
			$cart = "";

		return view('cart')->with('user_id', $user_id)
							->with('cookie_board', $cookie_board)
							->with('cart', $cart);
	}

	public function delete(Request $request){
		$check = $request->check;

		$board_writer = $request->board_writer;

		if(Auth::check()){
			$user_id = Auth::user()->user_id;
		}else{
			return back()->with('alert', '로그인해라');
		}

		if($user_id != $board_writer){
			if(Auth::user()->user_auth != "TOP"){
				return back()->with('alert','작성자만 삭제할수 있습니다.');
			}
		}

		if($check){
			$size = sizeof($check);
			$size -= 1;
			$check[$size] = (int)preg_replace("/[^0-9.]/", "", $check[$size]);	//마지막 문자에 쉼표 지우기
			$lastNum = $check[$size];

			$num = "";	//sql in문에 넣기 위함

			foreach($check as $row){
				$num = $num.$row;
			}

			Board::whereIn('board_num', $check)->delete();

			return redirect('board_page')->with('alert', '해당 항목들을 삭제하였습니다!');
		}

		$page = $request->page;
		$board_num = $request->num;
		$board_writer = $request->writer;

		if(Auth::user()->user_id == $board_writer){

			Board::where('board_num', $board_num)->delete();

			return redirect('board_page')->with('alert', '삭제 완료!');
		}else{
			return back()->with('alert', '작성자만 삭제 가능합니다.');
		}


	}

	public function update_page(Request $request){

		$board_writer = $request->id;
		$board_num = $request->num;

		$board_info = Board::where('board_num', $board_num)->first();

		$loc = Theater::where('board_num', $board_num)->first();

		if(Auth::check()){
			$user_id = Auth::user()->user_id;
		}else{
			return back()->with('alert', '로그인해라');
		}
		if(Auth::user()->user_id != $board_writer){
			if(Auth::user()->user_auth != "TOP"){
				return back()->with('alert','작성자만 수정할 수 있습니다.');
			}
		}

		$board_genre = Board::select('boards.board_genre', 'genres.Class')
						->join('genres', 'boards.board_genre', '=', 'genres.board_genre')
						->where('board_num', $board_num)
						->first()->Class;

		$start_term = $board_info->board_term_open;
		    $start = explode("-", $start_term);//날짜 나누기
		      $start_year = $start[0];
		      $start_month = $start[1];
		      $start_day = $start[2];
		$end_term = $board_info->board_term_close;
		    $end = explode("-", $end_term);//날짜 나누기
		      $end_year = $start[0];
		      $end_month = $start[1];
		      $end_day = $start[2];

		$board_viewingClass = viewingClass::where('viewingClass', $board_info->board_viewingClass)->first();
		$board_viewingClass = $board_viewingClass->Class;
		
		return view('updateBoard_page')->with('board_writer', $board_writer)
										->with('board_num', $board_num)
										->with('board_info', $board_info)
										->with('loc', $loc)
										->with('board_genre', $board_genre)
										->with('start_year', $start_year)
										->with('start_month', $start_month)
										->with('start_day', $start_day)
										->with('end_year', $end_year)
										->with('end_month', $end_month)
										->with('end_day', $end_day)
										->with('board_viewingClass', $board_viewingClass);
	}

	public function updateBoard(Request $request){

		$board_num = $request->board_num;
		
		$board_title = $request->title;

		$board_context = $request->contents;
		$board_writer = $request->writer;
		$board_opener = $request->opener;

		$start_year = $request->start_year;
		$start_month = $request->start_month;
		$start_day = $request->start_day;
		$start_term = $start_year."-".$start_month."-".$start_day;

		$end_year = $request->end_year;
		$end_month = $request->end_month;
		$end_day = $request->end_day;
		$end_term = $end_year."-".$end_month."-".$end_day;

		$board_genre = $request->genre;
		$board_place = $request->place;
		$board_time = $request->time;
		$board_price = $request->price;
		$board_viewingClass = $request->viewingClass;

		$board_picture = "board_picture";

		$theater_lat = $request->theater_lat;
		$theater_lng = $request->theater_lng;


		if($board_title && $board_context){
			if($board_picture == ""){
				$board_picture = $request->no_select;
			}

			$board = new Board;
			$theater = new Theater;

			$board->modifyBoard($board_num, $board_title, $board_context, $board_writer, $board_opener, $start_term, $end_term, $board_place, $board_time, $board_viewingClass, $board_price, $board_genre, $board_picture);
			$theater->modifyLocation($board_num, $board_place, $theater_lat, $theater_lng);

			return redirect('board_view?board_num='.$board_num)->with('alert', '수정이 완료되었습니다.');
		}else{
			return back()->with('alert', '항목을 모두 채워주세요');
		}

	}

	public function viewTheaterMaps(Request $request){

		$board_num = $request->board_num;

		$location = Theater::where('board_num', $board_num)->first();

		$lat = $location->theater_lat;
		$lng = $location->theater_lng;

		return view('viewTheaterMaps')->with('lat', $lat)
									->with('lng', $lng);
	}

	public function search(Request $request){

		$search = $request->search_bar;

		if(!$search)
			$serch = NULL;

		$result = Board::where('board_title', 'like', '%'.$search.'%')->get();

		return view('search')->with('search', $search)
							->with('result', $result);
	}
}
?>