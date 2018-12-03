<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    //protected $primaryKey = 'user_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array


     */

    public $timestamps = false;

    public $primaryKey = 'user_id';

    protected $fillable = [
        'user_id', 'password', 'user_name', 'email', 'user_phone', 'user_birth', 'user_postcode', 'user_addr',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'user_id'=>'string',
    ];

    /*public function boards(){
        return $this->hasMany(Board::class);
    }*/

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function updateInformation($id, $password, $name, $email, $phone, $birth, $postcode, $addr, $profile){
        User::where('user_id', $id)->update([
            'password' => Hash::make($password),
            'user_name' => $name,
            'email' => $email,
            'user_phone' => $phone,
            'user_birth' => $birth,
            'user_postcode' => $postcode,
            'user_addr' => $addr,
            'user_profile' => $profile,
        ]);
    }

}
