<?php

namespace App\Providers;

use App\Services\JsonPlaceHolderClient\JsonPlaceHolderClient;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class JsonPlaceHolderClientProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(JsonPlaceHolderClient::class, function ($app) {
            $client = new Client($app['config']['services']['jsonplaceholder']);
            return new JsonPlaceHolderClient($client);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
