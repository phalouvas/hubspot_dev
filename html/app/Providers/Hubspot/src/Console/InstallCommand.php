<?php

namespace Smsto\Hubspot\Console;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @var string
     */
    protected $signature = 'hubspot:install {--composer=global : Absolute path to the Composer binary which should be used to install packages}';

    /**
     * The console command description.
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @var string
     */
    protected $description = 'Install the Hubspot components and resources';

    /**
     * Execute the console command.
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @return void
     */
    public function handle()
    {
        $this->setConfigDatabase();
        $this->seedUsers();
        $this->line('');
        $this->info('Hubspot installed successfully.');
    }

    /**
     * Create administrator user
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @return void
     */
    protected function seedUsers() {
        if(User::first() == null) {
            User::factory()->create([
                'name' => 'Administrator',
                'email' => 'admin@sms.to',
                'password' => Hash::make('admin'), // password
           ]);
        }
    }

    /**
     * Set the connection in database config file
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     * @return void
     */
    protected function setConfigDatabase() {
        $connection_name = DB::getDefaultConnection();
        $connections = config('database.connections');
        $default_connection = $connections[$connection_name];
        $default_connection['prefix'] = 'hubspot_';
        $default_connection['strict'] = 1;
        $path = __DIR__ . '/../../config/database.php';
        $search = "'hubspot' => [],";
        $replace = "'hubspot' => [" . PHP_EOL;
        foreach ($default_connection as $key => $value) {
            $replace .= "           '$key' => ";
            if (is_string($value)) {
                $replace .= "'$value'," . PHP_EOL;
            }
            elseif (is_array($value)) {
                $replace .= "[]," . PHP_EOL;
            }
            elseif (is_null($value)) {
                $replace .= "null," . PHP_EOL;
            }
            else {
                $replace .= "$value," . PHP_EOL;
            }
        }
        $replace .= "       ],";
        $this->replaceInFile($search, $replace, $path);
    }

    /**
     * Replace a given string within a given file.
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $path
     * @return void
     */
    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }

}
