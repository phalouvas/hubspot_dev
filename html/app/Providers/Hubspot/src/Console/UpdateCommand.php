<?php

namespace Smsto\Hubspot\Console;

use Exception;
use HubSpot\Client\Files\Model\Folder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @var string
     */
    protected $signature = 'hubspot:update';

    /**
     * The console command description.
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @var string
     */
    protected $description = 'Update the Hubspot components and resources';

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
        $this->copyStubs();
        $this->updateActions();
        $this->line('');
        $this->info('Hubspot updated successfully.');
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

    /**
     * Update all workflow custom actions on HubSpot
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @return void
     */
    protected function updateActions()
    {

        $jsons = collect(config('hubspot.jsons'));

        $endpoint = "https://api.hubapi.com/automation/v4/actions/" . config('hubspot.app_id') . "?hapikey=" . config('hubspot.api_key');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response    = json_decode(curl_exec($ch), true);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        foreach ($response['results'] as $value) {
            $json = $jsons->firstWhere('actionName', $value['labels']['en']['actionName']);
            $endpoint = "https://api.hubapi.com/automation/v4/actions/" . config('hubspot.app_id') . "/" . $value['id'] . "?hapikey=" . config('hubspot.api_key');
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $endpoint);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "accept: application/json",
                'Content-Type: application/json'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_ENCODING, "");
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json['payload']);

            $response    = curl_exec($ch);
            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        }
    }

    /**
     * Copy stubs
     *
     * @return void
     */
    protected function copyStubs() {
        File::deleteDirectory(public_path('assets/hubspot'));
        File::copyDirectory(__DIR__.'/../../stubs/public/assets', public_path('assets/hubspot'));
    }

}
