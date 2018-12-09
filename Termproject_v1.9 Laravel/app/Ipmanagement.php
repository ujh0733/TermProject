<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ipmanagement extends Model
{	
	public $timestamps = false;

	protected $fillable = ['ip_address'];


	public function createBan($ip){
    	Ipmanagement::create([
    		'ip_address' => $ip,
        ]);
    }

    public function deleteBan($ip){
        Ipmanagement::where('ip_address', $ip)
                ->delete();
    }

}
