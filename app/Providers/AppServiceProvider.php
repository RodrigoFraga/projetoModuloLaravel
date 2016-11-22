<?php

namespace projetoModuloLaravel\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use projetoModuloLaravel\Entities\ProjetoTask;
use projetoModuloLaravel\Events\TaskWasIncluded;
use projetoModuloLaravel\Events\TaskWasUpdated;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ProjetoTask::created(function ($task) {
            Event::fire(new TaskWasIncluded($task));
        });
        ProjetoTask::updated(function ($task) {
            Event::fire(new TaskWasUpdated($task));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
