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
            $table->uuid('code')->index();
            $table->text('access_token')->nullable();
            $table->uuid('refresh_token')->nullable();
            $table->integer('expires_in')->nullable();
            $table->integer('expires_at')->nullable();
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
