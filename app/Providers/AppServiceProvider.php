<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Running with function
        require_once app_path() . '/Helper/function.php';
        require_once app_path() . '/Helper/querylibrary.php';

        // Always redirect to https.
        if($this->app->environment() === 'production') {
            $this->app['request']->server->set('HTTPS', true);
        }
    }
}
