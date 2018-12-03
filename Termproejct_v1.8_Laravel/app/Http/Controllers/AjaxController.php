<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Contracts\ArrayableInterface;
use DateTime;
use App\User;
use App\Seat;
use App\Board;
use App\Comment;

class AjaxController extends Controller
{
    public function comment(Request $request){
        $board_num = $request->num;
        $user_id = $request->id;
        $user_name = $request->name;
        $comment_txt = $request->txt;

        $com = new Comment();
        $com->createComment($board_num, $user_id, $user_name, $comment_txt);

        $cnt = Comment::where('board_num', $board_num)->count();
        $get = Comment::where('comment_userId', $user_id)->orderBy('comment_date', 'desc')->first();
        $profile = User::where('user_id', $user_id)->first()->user_profile;

        $response = array(
            'cnt' => $cnt,
            'id' => $get->comment_userId,
            'name' => $get->comment_userName,
            'txt' => $get->comment_txt,
            'date' => $get->comment_date,
            'profile' => $profile,
        );

        return response()->json($response);
    }

    public function getList(Request $request){
        if($request->ajax()){
            $start = $request->start;
            $list = $request->list;
            $genre = $request->genre;

            $cnt = $start + 1;

            $get = Board::where('board_genre', $genre)->orderBy('board_num', 'desc')->skip($start)->take($list)->get();

            $data = [];
            foreach($get as $rows){             //필요데이터만 추출
                $data[] = [
                    'board_num' => $rows->board_num,
                    'board_picture' => $rows->board_picture,
                    'board_title' => $rows->board_title,
                    'board_opener' => $rows->board_opener,
                    'board_term_open' => $rows->board_term_open,
                    'board_term_close' => $rows->board_term_close,
                ];
            }
            $data = json_encode($data);
            return $get;
        }else{
            return 0;
        }
    }

    public function getSeats(Request $request){
        if($request->ajax()){
            $board_num = $request->num;
            $day = $request->day;
            $price = $request->price;
            $cnt = $request->cnt;

            $seat = Seat::where('board_num', $board_num)->where('board_day', $day)->first()->board_seat;
            return $seat;
        }else{
            return 'Server Errors...';
        }
    }

    public function idCheck(Request $request){
        if($request->ajax()){
            $user_id = $request->id;
            $check = User::where('user_id', $user_id)->first();

            if($check)
                return 1;
            else
                return 0;
        }else{ 
            return 'Server Errors....';
        }
    }


}
?>