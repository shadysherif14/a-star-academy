<?php

namespace App\Http\Controllers;

use App\Term;


class TermsController extends Controller
{
    public function index(){
        $terms = Term::all()->sortBy('disp_order');
        $policy = "terms";
        return view('terms.index',compact('policy','terms'));
    }
    
    public function cookies(){
        $policy = "cookies";
        return view('terms.index',compact('policy'));
    }
}
