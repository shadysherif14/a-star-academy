<?php

Route::domain(config('app.url'))
    ->namespace('User')
    ->group(function () {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout')->name('logout');
        Route::post('users/logoutalldevices', 'LoginController@logoutAllDevices');

        // Registration Routes...
        Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'RegisterController@register');
        
        Route::post('/validate-registration', 'RegisterController@validateBasicInformation')->name('register.validate');
        
        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail');
        Route::post('/password/reset', 'ResetPasswordController@reset');
        
        Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm');
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    });

Route::domain('admin.' . config('app.url'))

    ->namespace('Admin')

    ->name('admin.')

    ->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login');
        Route::any('/logout', 'LoginController@logout')->name('logout');
        
        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail');
        Route::post('/password/reset', 'ResetPasswordController@reset');
        
        Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm');
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    });

Route::domain('instructor.' . config('app.url'))

    ->namespace('Instructor')

    ->name('instructor.')

    ->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login');
        Route::post('/logout', 'LoginController@logout')->name('logout');

        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail');
        Route::post('/password/reset', 'ResetPasswordController@reset');

        Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm');
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    });