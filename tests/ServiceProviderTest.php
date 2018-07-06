<?php

namespace Tests;

use Kemp\KempClient;
use Kemp\KempFacade;
use Kemp\KempServiceProvider;
use Storage;
use Mockery;

class ServiceProviderTest extends TestCase
{
    /**
     * Load package service provider
     * @param  \Illuminate\Foundation\Application $app
     * @return SignhostServiceProvider
     */
    protected function getPackageProviders($app)
    {
        return [KempServiceProvider::class];
    }
    /**
     * Load package alias
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Kemp' => KempFacade::class,
        ];
    }

    /** @test */
    public function can_connect_to_kemp_loadmaster()
    {
        $config = $this->app['config'];
        $client = KempClient::addVirtualService($config->get('services.kemp.ipAddress'), $config->get('services.kemp.username'), $config->get('services.kemp.password'), $config->get('services.kemp.certificate'));
    }
}
