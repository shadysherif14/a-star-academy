<?php

Route::domain(config('app.url'))

    ->group(function () {
        Route::get('/', 'HomeController')->name('home');
        
        Route::get('/courses', function () {
            return view('app.courses.index');
        });

        Route::resource('courses', 'CourseController')->only('index', 'show');

        Route::resource('instructors', 'InstructorController')->only('index', 'show');

        Route::resource('videos', 'VideoController')->only('show');

        Route::post('{video}/subscribe', 'VideoController@subscribe')->name('videos.subscribe');

        Route::post('{video}/payment-key', 'VideoController@paymentKey')->name('videos.payment-key');

        Route::post('quizzes/{video}', 'QuizController@store')->name('quizzes.store');
        
        Route::post('like/{course}', 'LikeController@course')->name('like.courses');

        Route::post('profiles', 'ProfileController@update')->name('profiles.update')->middleware('auth');

        Route::get('profile', 'ProfileController@show')

            ->name('profiles.show')

            ->middleware('auth');

        
        Route::put('subscription-date/{videoID}', 'VideoController@updateSubscriptionEndDate')
        
        ->name('subscription.update.date')
        
        ->middleware('auth');
        

        Route::any('/api/process-callback', 'VideoController@processedCallback');

        Route::any('/api/response-callback', 'VideoController@responseCallback');

        Route::post('contact-us', 'ContactController')->name('contact.send');

        Route::post('question', 'QuestionController')->name('question.send');
    });