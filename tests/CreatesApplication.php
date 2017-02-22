<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Mediumart\Intercom\IntercomServiceProvider;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../vendor/laravel/laravel/bootstrap/app.php';

        $app->register(IntercomServiceProvider::class);

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
