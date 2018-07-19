<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('homepage.app');
});


Route::resource('levels', 'LevelController');
Route::resource('courses', 'CourseController');

Route::prefix('admin')->group(function () {

    Route::get('', function () {
        return view('homepage.admin');
    });

/*     Route::get('/factory', function () {
        $levels = factory(App\Level::class, 8)
            ->create()
            ->each(function ($level) {

                factory(App\Course::class, 5)->create([
                    'level_id' => $level->id
                ]);
            });

            return redirect('/admin');
    });

    Route::get('levels', 'LevelController@index'); */
});
