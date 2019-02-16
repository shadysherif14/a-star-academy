<?php

Route::get('/terms', 'TermsController@index')->name('terms');
Route::get('/cookies', 'TermsController@cookies')->name('cookies');
Route::get('/faq', 'TermsController@faq')->name('faq');
