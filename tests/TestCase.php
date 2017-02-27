<?php

namespace Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            \Mediumart\Intercom\IntercomServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Intercom' => \Mediumart\Intercom\Intercom::class,
        ];
    }
}
