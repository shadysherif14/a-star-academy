<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Route::domain('admin.' . config('app.url'))

    ->name('admin.')

    ->group(function () {

        Route::get('/', 'DashboardController')->name('home');

        Route::post('/levels/{level}', 'LevelController@update')->name('levels.update');
        Route::resource('/levels', 'LevelController')->except('update');

        Route::post('/courses/{course}', 'CourseController@update')->name('courses.update');
        Route::resource('/courses', 'CourseController')->except('update');

        Route::resource('/videos', 'VideoController')->only(['edit', 'destroy', 'show']);
        Route::put('/order/videos', 'VideoController@order')->name('videos.order');
        Route::post('/videos/{video}', 'VideoController@update')->name('videos.update');
        Route::resource('/{course}/videos', 'VideoController')->only(['index', 'store', 'create']);

        Route::put('/order/quizzes', 'QuestionController@order')->name('quizzes.order');
        Route::resource('/{video}/quizzes', 'QuestionController')->only(['index', 'store', 'create']);
        Route::resource('/quizzes', 'QuestionController')->only(['show', 'update', 'destroy']);

        Route::resource('/instructors', 'InstructorController');

        Route::get('/payables/{payable}', 'PayMobOrderController@show')->name('payables.show');

        Route::post('/payables/{payable}', 'PayMobOrderController@pay')->name('payables.pay');

        Route::resource('/students', 'UserController');

        Route::get('/test', function() {

            dd(json_decode(App\Instructor::first()->accounts)->facebook);

        });
    }
);
