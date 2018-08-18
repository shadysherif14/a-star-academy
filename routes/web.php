<?php

use Illuminate\Support\Facades\Storage;

// Use subdoamin for admin
Route::domain('admin.astaracademy.test')
    ->name('admin.')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function () {

        Route::view('/', 'homepage.admin');

        Route::post('/levels/{level}', 'LevelController@update')->name('levels.update');
        Route::resource('/levels', 'LevelController')->except('update');

        Route::post('/courses/{course}', 'CourseController@update')->name('courses.update');
        Route::resource('/courses', 'CourseController')->except('update');

        Route::resource('/videos', 'VideoController')->only(['edit', 'destroy']);
        Route::put('/order/videos', 'VideoController@order')->name('videos.order');
        Route::post('/videos/{video}', 'VideoController@update')->name('videos.update');
        Route::resource('/{course}/videos', 'VideoController')->only(['index', 'store', 'create']);
        
        Route::put('/order/quizzes', 'QuestionController@order')->name('quizzes.order');
        Route::resource('/{video}/quizzes', 'QuestionController')->only(['index', 'store', 'create']);
        Route::resource('/quizzes', 'QuestionController')->only(['show', 'update', 'destroy']);
        
        Route::resource('/instructors', 'InstructorController');
    });
/*
Route::prefix('admin')->name('admin.')->group(function () {

Route::view('/', 'homepage.admin');

Route::resource('/levels', 'LevelController');

Route::resource('/courses', 'CourseController');

Route::put('/order/videos', 'VideoController@order')->name('videos.order');
Route::resource('/{course}/videos', 'VideoController')->only(['index', 'store', 'create']);
Route::resource('/videos', 'VideoController')->only(['edit', 'update', 'destroy']);

Route::resource('/instructors', 'InstructorController');
});
 */

// Add attributes to array as prefix, middelwares, ...
Route::group(array('namespace' => 'User'), function () {

    //Route::resource('/courses', 'CourseController')->only(['index', 'show']);

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/ig/courses/{crs}', 'IgController@courses');

    Route::get('/sat/courses/{crs}', 'SatController@courses');
    Route::post('/sat/video', 'SatController@fetchVideo');


});

Auth::routes();

Route::view('/test', 'file');
