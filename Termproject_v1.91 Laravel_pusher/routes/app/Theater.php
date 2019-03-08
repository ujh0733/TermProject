<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
	public $timestamps = false;

	protected $fillable = [
    	'board_num', 'theater_name', 'theater_lat', 'theater_lng'
    ];

    public function createLocation($count, $place, $lat, $lng){
    	Theater::create([
    		'board_num'=>$count,
    		'theater_name'=>$place,
    		'theater_lat'=>$lat,
    		'theater_lng'=>$lng,
    	]);
    }

    public function modifyLocation($num, $place, $lat, $lng){
        Theater::where('board_num', $num)->update([
            'theater_name'=>$place,
            'theater_lat'=>$lat,
            'theater_lng'=>$lng,
        ]);
    }
}
