<?php

use Illuminate\Support\Facades\Storage;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::view('', 'homepage.admin');

    Route::post('/levels/{level}', 'LevelController@update')->name('levels.update');
    Route::resource('/levels', 'LevelController')->except('update');

    Route::post('/courses/{course}', 'CourseController@update')->name('courses.update');
    Route::resource('/courses', 'CourseController')->except('update');

    Route::put('/order/videos', 'VideoController@order')->name('videos.order');
    Route::post('/videos/{video}', 'VideoController@update')->name('videos.update');
    Route::resource('/{course}/videos', 'VideoController')->only(['index', 'store', 'create']);
    Route::resource('/videos', 'VideoController')->only(['edit', 'destroy']);

    Route::put('/order/quizzes', 'QuestionController@order')->name('quizzes.order');
    Route::resource('/{video}/quizzes', 'QuestionController')->only(['index', 'store', 'create']);
    Route::resource('/quizzes', 'QuestionController')->only(['show', 'update', 'destroy']);

    Route::resource('/instructors', 'InstructorController');
});

Route::prefix('/')->group(function () {

    Route::resource('/courses', 'CourseController')->only(['index', 'show']);

    Route::get('/', function () {
        return view('test2');
    });

    Route::get('/school/{type}', function ($type) {

        return view('grades');
    });

    Route::get('/grades', function () {
        return view('grades');
    });

    Route::get('/video', function () {
        return view('video');
    });

});


Route::view('/test', 'file');