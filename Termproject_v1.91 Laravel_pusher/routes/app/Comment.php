<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{	
    public $timestamps = false;

    protected $fillable = [
        'board_num', 'comment_userId', 'comment_userName', 'comment_txt',
    ];

	public function user(){
        return $this->belongsTo(User::class, 'comment_userId');
    }

    public function createComment($num, $id, $name, $txt){
    	Comment::create([
    		'board_num' => $num,
    		'comment_userId' => $id,
    		'comment_userName' => $name,
    		'comment_txt' => $txt,
    	]);
    }

    public function modifyComment($num, $id, $date, $txt){
        Comment::where('board_num', $num)
                ->where('comment_userId', $id)
                ->where('comment_date', $date)
                ->update([
            'comment_txt' => $txt,
        ]);
    }

    public function deleteComment($num, $id, $date){
        Comment::where('board_num', $num)
                ->where('comment_userId', $id)
                ->where('comment_date', $date)
                ->delete();
    }
}
