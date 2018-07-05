<?php

namespace Tests;

use SteffjeNL\LaravelKemp\KempClient;
use Storage;
use Mockery as m;

class ServiceProviderTest extends TestCase
{
    /** @test */
    public function can_connect_to_kemp_loadmaster()
    {
        $config = $this->app['config'];
        $client = new KempClient($config->get('services.kemp.ipAddress'), $config->get('services.kemp.username'), $config->get('services.kemp.password'), $config->get('services.kemp.certificate'));

    }
}
