<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SolariumServiceProvider extends ServiceProvider
{
	
	    protected $defer = true;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Client::class, function ($app) {
            return new Client($app['config']['solarium']);
        });
    }
	public function provides()
    {
        return [Client::class];
    }
}
