<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    
    public function __construct(Route $route)
    {  
        dd($route);   
    }
}
