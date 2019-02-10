<?php

Route::domain('instructor.' . config('app.url'))

    ->name('instructor.')

    ->group(function () {

        Route::get('/', 'DashboardController@index')->name('home');
        Route::get('/subscriptions', 'DashboardController@subscriptions')->name('subscriptions');        
        Route::get('/profile', 'ProfileController@show')->name('profile.show');
        Route::post('/profile', 'ProfileController@update')->name('profile.update');
        Route::resource('/courses', 'CourseController')->only('index', 'show');
    });
