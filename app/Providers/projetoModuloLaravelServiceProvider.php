<?php

namespace projetoModuloLaravel\Providers;

use Illuminate\Support\ServiceProvider;

class projetoModuloLaravelServiceProvider extends ServiceProvider
{
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
        $this->app->bind(
            \projetoModuloLaravel\Repositories\ClienteRepository::class,
            \projetoModuloLaravel\Repositories\ClienteRepositoryEloquent::class
        );
    }
}
