<?php

namespace Smsto\Hubspot;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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
        try {
            $this->mergeConfigFrom(config_path('hubspot.php'), 'hubspot');
            $this->mergeConfigFrom(config_path('hubspot_connection.php'), 'database.connections');
        } catch (\Throwable $th) {
            $this->install();
        }

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
            $this->registerComponent('form');
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
     * First time run
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @return void
     */
    protected function install()
    {
        /**
         * Add config files
         */
        File::copy(__DIR__ . '/../stubs/config/hubspot.php', config_path('hubspot.php'));
        File::copy(__DIR__ . '/../stubs/config/hubspot_connection.php', config_path('hubspot_connection.php'));

        $connection_name = DB::getDefaultConnection();
        $connections = config('database.connections');
        $default_connection = $connections[$connection_name];
        $default_connection['prefix'] = 'hubspot_';
        $default_connection['strict'] = 1;
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

        file_put_contents(config_path('hubspot_connection.php'), str_replace($search, $replace, file_get_contents(config_path('hubspot_connection.php'))));
        config()->set('database.connections.hubspot', $default_connection);

        /**
         * Add middleware
         */
        $search = 'protected $routeMiddleware = [';
        $replace = 'protected $routeMiddleware = [
        \'hubspot\' => \Smsto\Hubspot\Http\Middleware\ValidateHubspotRequest::class,';
        file_put_contents(app_path('Http/Kernel.php'), str_replace($search, $replace, file_get_contents(app_path('Http/Kernel.php'))));
    }

}
