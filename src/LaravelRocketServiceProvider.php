<?php

namespace PrinceNoman\LaravelRocket;

use Illuminate\Support\ServiceProvider;

class LaravelRocketServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\MakeModelsCommand::class,
                Commands\MakeMigrationsCommand::class,
                Commands\MakeControllersCommand::class,
                Commands\MakeRequestsCommand::class,
                Commands\MakeFactoriesCommand::class,
                Commands\MakeSeedersCommand::class,
            ]);
        }
    }

    public function register()
    {
        //
    }
}