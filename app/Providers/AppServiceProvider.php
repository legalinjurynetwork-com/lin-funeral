<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\API\Konnektive;
use App\Http\API\ClientInterface;
use App\Http\API\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ClientInterface::class, function ($app) {
            return new Client;
        });

        $this->app->bind(Konnektive::class, function ($app) {
            return new Konnektive(env("KONNEKTIVE_USERNAME", "lab270api"), env("KONNEKTIVE_PASSWORD", "uSrMu3Vx3t7W"), new Client );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
