<?php

Route::domain('admin.' . config('app.url'))

    ->name('admin.')

    ->group(function () {

        Route::get('/', 'DashboardController@index')->name('home');

        Route::post('/levels/{level}', 'LevelController@update')->name('levels.update');
        Route::resource('/levels', 'LevelController')->except('update');

        Route::post('/courses/{course}', 'CourseController@update')->name('courses.update');
        Route::resource('/courses', 'CourseController')->except('update');

        Route::resource('/videos', 'VideoController')->only(['edit', 'destroy', 'show']);
        Route::put('/order/videos', 'VideoController@order')->name('videos.order');
        Route::post('/videos/{video}', 'VideoController@update')->name('videos.update');
        Route::resource('/{course}/videos', 'VideoController')->only(['index', 'store', 'create']);

        Route::put('/order/questions', 'QuestionController@order')->name('questions.order');
        Route::resource('/{video}/questions', 'QuestionController')->only(['index', 'store', 'create']);
        Route::resource('/questions', 'QuestionController')->only(['show', 'update', 'destroy']);

        Route::resource('/instructors', 'InstructorController');

        Route::get('/payables/{payable}', 'PayMobOrderController@show')->name('payables.show');

        Route::post('/payables/{payable}', 'PayMobOrderController@pay')->name('payables.pay');

        Route::resource('/users', 'UserController');

    }
    );

