<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
	public $timestamps = false;

    protected $fillable = [
    	'board_num', 'board_title', 'board_context', 'board_writer', 'board_opener', 'board_term_open', 'board_term_close', 'board_posted', 'board_viwed', 'board_place', 'board_performanceTime', 'board_viewingClass', 'board_price', 'board_genre', 'board_picture'
    ];

    public function createBoard($count, $title, $context, $writer, $opener, $start_term, $end_term, $place, $time, $viewingClass, $price, $genre, $picture){
    	Board::create([
    		'board_num'=>$count,
    		'board_title'=>$title,
    		'board_context'=>$context,
    		'board_writer'=>$writer,
    		'board_opener'=>$opener,
    		'board_term_open'=>$start_term,
    		'board_term_close'=>$end_term,
    		'board_place'=>$place,
    		'board_performanceTime'=>$time,
    		'board_viewingClass'=>$viewingClass,
    		'board_price'=>$price,
    		'board_genre'=>$genre,
    		'board_picture'=>$picture,
    	]);
    }

    public function modifyBoard($num, $title, $context, $writer, $opener, $start_term, $end_term, $place, $time, $viewingClass, $price, $genre, $picture){
        Board::where('board_num', $num)->update([
            'board_title'=>$title,
            'board_context'=>$context,
            'board_writer'=>$writer,
            'board_opener'=>$opener,
            'board_term_open'=>$start_term,
            'board_term_close'=>$end_term,
            'board_place'=>$place,
            'board_performanceTime'=>$time,
            'board_viewingClass'=>$viewingClass,
            'board_price'=>$price,
            'board_genre'=>$genre,
            'board_picture'=>$picture,
        ]);
    }

    public function increaseBoard($num){
        $viewed = Board::where('board_num', $num)->first()->board_viewed;
        Board::where('board_num', $num)->update([
            'board_viewed'=>$viewed + 1,
        ]);
    }

    
    public function purchases(){
        return $this->hasMany(Purchase::class);
    }

}