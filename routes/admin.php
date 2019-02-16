<?php

Route::domain('admin.' . config('app.url'))

    ->name('admin.')

    ->group(function () {

        Route::get('/', 'DashboardController@index')->name('home');
        Route::get('/subscriptions', 'DashboardController@subscriptions')->name('subscriptions');

        Route::get('/profile', 'ProfileController@show')->name('profile.show');
        Route::post('/profile', 'ProfileController@update')->name('profile.update');

        Route::post('/levels/{level}', 'LevelController@update')->name('levels.update');
        Route::resource('/levels', 'LevelController')->except('update');

        Route::post('/courses/{course}', 'CourseController@update')->name('courses.update');
        Route::resource('/courses', 'CourseController')->except('update');

        Route::put('{video}/poster', 'PosterController@update')->name('posters.update');
        Route::resource('/videos', 'VideoController')->only(['edit', 'destroy', 'show']);
        Route::put('/order/videos', 'VideoController@order')->name('videos.order');
        Route::post('/videos/{video}', 'VideoController@update')->name('videos.update');
        Route::resource('/{course}/videos', 'VideoController')->only(['index', 'store', 'create']);

        Route::put('/order/questions', 'QuestionController@order')->name('questions.order');
        Route::resource('/{video}/questions', 'QuestionController')->only(['index', 'store', 'create']);
        Route::resource('/questions', 'QuestionController')->only(['show', 'update', 'destroy']);

        Route::post('/instructors/{instructor}', 'InstructorController@update')->name('instructors.update');
        Route::resource('/instructors', 'InstructorController')->except('update');

        Route::get('/payables/{payable}', 'PayMobOrderController@show')->name('payables.show');

        Route::post('/payables/{payable}', 'PayMobOrderController@pay')->name('payables.pay');

        Route::resource('/users', 'UserController')->only('index', 'show', 'destroy', 'create', 'store');
        Route::put('/users/block/{user}', 'UserController@toggleBlock')->name('users.toggle-block');


        Route::get('/create-dirs', function () {
            Course::all()->each(function ($course) {

                if(!Storage::exists("public/sessions/{$course->slug}/videos")) {
                    Storage::makeDirectory("public/sessions/{$course->slug}/videos");
                }
                if (!Storage::exists("public/sessions/{$course->slug}/posters")) {
                    Storage::makeDirectory("public/sessions/{$course->slug}/posters");
                }
            });

        });

    });
