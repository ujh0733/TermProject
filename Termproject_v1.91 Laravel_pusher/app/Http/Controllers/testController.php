<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testController extends Controller
{
    public function arrayTest(Request $request){
        return view('arrayTest');
    }
    
}