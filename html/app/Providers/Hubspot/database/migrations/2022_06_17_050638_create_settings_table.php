<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('settings', function (Blueprint $table) {
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
        Schema::dropIfExists('settings');
    }
};
