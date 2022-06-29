<?php

namespace Smsto\Hubspot;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
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
        $this->mergeConfigFrom(__DIR__ . '/../config/hubspot.php', 'hubspot');
        $this->mergeConfigFrom(__DIR__ . '/../config/database.php', 'database.connections');
        $this->setConfigDatabase();
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
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
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'hubspot');
        $this->configureComponents();
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/admin.php');
        Paginator::useBootstrap();

        $this->notRunningInConsole();
    }

    protected function notRunningInConsole()
    {
        if (!$this->app->runningInConsole()) {
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
        Blade::component('hubspot::components.' . $component, 'hub-' . $component);
    }

    /**
     * Set the connection in database config file
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     * @return void
     */
    protected function setConfigDatabase()
    {
        if (empty(config('database.connections.hubspot'))) {
            $connection_name = DB::getDefaultConnection();
            $connections = config('database.connections');
            $default_connection = $connections[$connection_name];
            $default_connection['prefix'] = 'hubspot_';
            $default_connection['strict'] = 1;
            $path = __DIR__ . '/../config/database.php';
            $search = "'hubspot' => [],";
            $replace = "'hubspot' => [" . PHP_EOL;
            foreach ($default_connection as $key => $value) {
                $replace .= "           '$key' => ";
                if (is_string($value)) {
                    $replace .= "'$value'," . PHP_EOL;
                } elseif (is_array($value)) {
                    $replace .= "[]," . PHP_EOL;
                } elseif (is_null($value)) {
                    $replace .= "null," . PHP_EOL;
                } else {
                    $replace .= "$value," . PHP_EOL;
                }
            }
            $replace .= "       ],";

            file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
            config()->set('database.connections.hubspot', $default_connection);
        }
    }
}
