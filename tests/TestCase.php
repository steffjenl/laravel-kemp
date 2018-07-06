<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return ['Kemp\KempServiceProvider'];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default

        $app['config']->set('services.kemp', [
            'ipAddress' => env('KEMP_IPADDRESS'),
            'username'  => env('KEMP_USERNAME'),
            'password'  => env('KEMP_PASSWORD'),
        ]);

    }
}
