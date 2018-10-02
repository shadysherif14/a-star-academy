<?php

use Illuminate\Support\Facades\Storage;

// Add attributes to array as prefix, middelwares, ...
Route::group(array('namespace' => 'User'), function () {

    //Route::resource('/courses', 'CourseController')->only(['index', 'show']);

    Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

    Route::get('/courses', function () {

        return view('app.courses.index');
    });

    Route::get('/ig/courses/{crs}', 'IgController@courses');

    Route::get('/sat/courses/{crs}', 'SatController@courses');
    Route::post('/sat/video', 'SatController@fetchVideo');

});

Route::namespace ('Auth')->group(function () {

    Route::post('/config/basic-info', 'UsersConfigController@basicInformation')->name('config.basic');

});

Route::get('/out', function () {

    auth()->logout();


});

Auth::routes();
