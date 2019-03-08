<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
	public $timestamps = false;

	protected $fillable = ['board_num', 'board_seat', 'board_day'];

    public function createSeat($num, $seat, $day){
    	Seat::create([
    		'board_num' => $num,
    		'board_seat' => $seat,
    		'board_day' => $day,
    	]);
    }

    public function updateSeat($num, $seat, $day){
    	Seat::where('board_num', $num)->where('board_day', $day)->update([
            'board_seat' => $seat,
        ]);
    }
}
