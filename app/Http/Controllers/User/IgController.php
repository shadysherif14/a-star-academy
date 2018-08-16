<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IgController extends Controller
{
    public function courses(Request $request){
        dd($request->grade);
    }
}
