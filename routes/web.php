<?php

use Illuminate\Support\Facades\Storage;



Route::prefix('admin')->group(function () {

    Route::get('', function () {
        return view('homepage.admin');
    });

    Route::resource('/levels', 'LevelController');
    Route::resource('/courses', 'CourseController');
    Route::resource('/{course}/videos', 'VideoController');
    Route::resource('/instructors', 'InstructorController');
});


Route::get('/', function () {
    return view('test2');
});


Route::get('/school/{type}',function($type){
    
    return view('grades');
});

Route::get('/grades',function(){
    return view('grades');
});

Route::get('/video',function(){
    return view('video');
});