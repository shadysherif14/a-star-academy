<?php

use Illuminate\Support\Facades\Storage;



Route::prefix('admin')->name('admin.')->group(function () {

    Route::view('', 'homepage.admin');

    Route::resource('/levels', 'LevelController');

    Route::resource('/courses', 'CourseController');

    Route::put('/order/videos', 'VideoController@order')->name('videos.order');
    Route::resource('/{course}/videos', 'VideoController')->only(['index', 'store', 'create']);
    Route::resource('/videos', 'VideoController')->only(['edit', 'update', 'destroy']);

    Route::resource('/instructors', 'InstructorController');
});


Route::prefix('/')->group(function() {

    Route::resource('/courses', 'CourseController')->only(['index', 'show']);

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

});

