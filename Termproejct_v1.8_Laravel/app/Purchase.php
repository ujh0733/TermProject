<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public $timestamps = false;

	protected $fillable = ['user_id', 'board_num', 'buy_seat', 'board_date'];

    public function buyTicket($id, $num, $seat, $day){
    	Purchase::create([
    		'user_id' => $id,
    		'board_num' => $num,
    		'buy_seat' => $seat,
    		'board_date' => $day,
    	]);
    }
}
