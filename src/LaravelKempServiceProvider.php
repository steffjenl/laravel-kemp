<?php

namespace SteffjeNL\LaravelKemp;

/**
 * Class LaravelKempServiceProvider
 *
 * @category  DevOps
 * @package   SteffjeNL\LaravelKemp
 * @author    Stephan Eizinga <stephan@monkeysoft.nl>
 * @copyright 2018 Stephan Eizinga
 * @link      https://github.com/steffjenl/laravel-kemp
 */
class LaravelKempServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands(
                [
                ]
            );
        }
    }

    /**
     * register
     */
    public function register()
    {
        $this->app->singleton(
            KempClient::class, function ($app) {
            return new KempClient(config('kemp.ipAddress'), config('kemp.username'), config('kemp.password'), config('kemp.certificate'));
        }
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            KempClient::class,
        ];
    }
}
