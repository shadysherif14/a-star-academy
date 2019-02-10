<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PayableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Interfaces\PayableInterface', 'App\Video');

        $this->app->bind('App\Interfaces\PayableInterface', 'App\Course');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
