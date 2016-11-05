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

        $this->app->bind(
            \projetoModuloLaravel\Repositories\ProjetoRepository::class,
            \projetoModuloLaravel\Repositories\ProjetoRepositoryEloquent::class
        );
        $this->app->bind(
            \projetoModuloLaravel\Repositories\ProjetoNotaRepository::class,
            \projetoModuloLaravel\Repositories\ProjetoNotaRepositoryEloquent::class
        );
        $this->app->bind(
            \projetoModuloLaravel\Repositories\ProjetoFileRepository::class,
            \projetoModuloLaravel\Repositories\ProjetoFileRepositoryEloquent::class
        );
        $this->app->bind(
            \projetoModuloLaravel\Repositories\UserRepository::class,
            \projetoModuloLaravel\Repositories\UserRepositoryEloquent::class
        );
        $this->app->bind(
            \projetoModuloLaravel\Repositories\ProjetoTaskRepository::class,
            \projetoModuloLaravel\Repositories\ProjetoTaskRepositoryEloquent::class
        );
    }
}
