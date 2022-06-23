<?php

namespace Smsto\Hubspot;

use Illuminate\Support\ServiceProvider;

class HubspotServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/hubspot.php', 'hubspot');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Bootstrap any application services.
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'hubspot');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');

        $this->notRunningInConsole();

    }

    protected function notRunningInConsole() {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Console\InstallCommand::class,
            Console\UpdateCommand::class,
        ]);
    }
}
