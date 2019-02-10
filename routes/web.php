<?php

use App\Http\Controllers\TermsController;

Route::get('/terms', 'TermsController@index')->name('terms');
Route::get('/cookies', 'TermsController@cookies')->name('cookies');
Route::get('/faq', 'TermsController@faq')->name('faq');