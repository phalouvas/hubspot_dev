<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->setConfigDatabase();
        Schema::connection('hubspot')->create('settings', function (Blueprint $table) {
            $table->id();

            $table->uuid('refresh_token');
            $table->integer('expires_in');
            $table->text('access_token');
            $table->integer('expires_at');
            $table->string('token_type');

            $table->string('user');
            $table->string('hub_domain');
            $table->json('scopes');
            $table->json('scope_to_scope_group_pks');
            $table->json('trial_scopes');
            $table->json('trial_scope_to_scope_group_pks');
            $table->integer('hub_id')->index();
            $table->integer('app_id')->index();
            $table->integer('user_id')->index();

            $table->text('api_key');
            $table->string('sender_id', 9)->nullable();
            $table->boolean('show_reports')->default(true);
            $table->boolean('show_people')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('hubspot')->dropIfExists('settings');
    }

    /**
     * Set the connection in database config file
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     * @return void
     */
    protected function setConfigDatabase()
    {
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
};
