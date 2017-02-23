<?php

namespace Mediumart\Intercom;

use Intercom\IntercomClient;
use Illuminate\Support\ServiceProvider;

class IntercomServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('intercom', function ($app) {
            return new Client( 
                new IntercomClient( config('services.intercom.token'), null ) 
            );
        });

        $this->app->bind(Client::class, function($app) {
            return $app->make('intercom');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['intercom', Client::class];
    }
}
