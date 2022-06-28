<?php

namespace Smsto\Hubspot;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

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
        $this->mergeConfigFrom(__DIR__.'/../config/database.php', 'database.connections');
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
        $this->configureComponents();
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');
        Paginator::useBootstrapFive();

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

    /**
     * Configure the Blade components.
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     * @return void
     */
    protected function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('layout');
        });
    }

    /**
     * Register the given component.
     *
     * @param  string  $component
     * @return void
     */
    protected function registerComponent(string $component)
    {
        Blade::component('hubspot::components.'.$component, 'hub-'.$component);
    }
}
