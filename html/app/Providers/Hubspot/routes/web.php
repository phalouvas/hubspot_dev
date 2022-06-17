<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'hubspot', 'middleware' => 'web'], function () {

    Route::get('/', [\Smsto\Hubspot\Http\Controllers\HubspotController::class, 'index'])->name('hubspot');

});
