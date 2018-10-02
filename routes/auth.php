<?php

Route::namespace('AdminAuth')

    ->prefix('admin')

    ->name('admin.')

    ->group(function () {

        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login');
        Route::post('/logout', 'LoginController@logout')->name('logout');

        Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('/register', 'RegisterController@register');

        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.request');
        Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.email');
        Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm');
    });
