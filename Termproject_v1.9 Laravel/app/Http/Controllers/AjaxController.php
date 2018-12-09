<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Contracts\ArrayableInterface;
use Illuminate\Support\Facades\Hash;
use DateTime;
use App\User;
use App\Seat;
use App\Board;
use App\Comment;
use App\Purchase;

class AjaxController extends Controller
{
    public function comment(Request $request){          //댓글
        $board_num = $request->num;
        $user_id = $request->id;
        $user_name = $request->name;
        $comment_txt = $request->txt;

        $comment_date = $request->date;

        $type = $request->type;

        $com = new Comment();

        if($type == 'write'){
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
                'msg' => '소중한 댓글 감사합니다.',
            );
        }else if($type == 'modify'){
            $com->modifyComment($board_num, $user_id, $comment_date, $comment_txt);

            $response = array(
                'txt' => $comment_txt,
                'msg' => '댓글이 수정되었습니다.',
            );
        }else if($type == 'delete'){
            $com->deleteComment($board_num, $user_id, $comment_date);

            $cnt = Comment::where('board_num', $board_num)->count();
            $response = array(
                'cnt' => $cnt,
                'msg' => '댓글이 삭제되었습니다.',
            );
        }

        return response()->json($response);
    }

    public function getList(Request $request){          //스크롤페이징
        if($request->ajax()){
            $start = $request->start;
            $list = $request->list;
            $genre = $request->genre;

            $cnt = $start + 1;

            $get = Board::where('board_genre', $genre)->orderBy('board_num', 'desc')->skip($start)->take($list)->get();

            return $get;
        }else{
            return 0;
        }
    }

    public function getSeats(Request $request){         //좌석구매
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

    public function idCheck(Request $request){              //회원가입 중복체크
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

    public function myPageGet(Request $request){       //마이페이지
        if($request->ajax()){
            $type = $request->type;
            $user_id = $request->id;
            if($type == 'myWrite'){
                $board = Board::where('board_writer', $user_id)->orderby('board_num', 'desc')->get();
            }else if($type == 'myBuy'){
                $board = Purchase::where('user_id', $user_id)->orderby('buy_date', 'desc')->get();
                $data = [];
                foreach($board as $row){
                    $data[] = [
                        'board_num' => $row->board_num,
                        'board_picture' => $row->board->board_picture,
                        'board_title' => $row->board->board_title,
                        'buy_seat' => $row->buy_seat,
                    ];
                }
                return response()->json($data);
            }else if($type == 'admin'){
                $board = '관리자페이지';
            }

            return response()->json($board);
        }else{ 
            return 'Server Errors...';
        }
    }

    public function withdrawal(Request $request){           //회원탈퇴
        if($request->ajax()){
            $pass = Hash::make($request->pass);
            $user = $request->user;
            User::where('user_id', $user)->delete();
            return 1;
        }else{
            return 'Server Errors...';
        }
    }


}
?>