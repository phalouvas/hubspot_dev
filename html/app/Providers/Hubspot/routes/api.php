<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'hubspot/api', 'middleware' => 'api'], function () {

    Route::prefix('/smsto')->group(function () {
        Route::get('/params', [\Smsto\Hubspot\Http\Controllers\SmstoController::class, 'params'])->name('hubspot.smsto.params');
        Route::any('/call', [\Smsto\Hubspot\Http\Controllers\SmstoController::class, 'call'])->name('hubspot.smsto.call');
        Route::any('/send', [\Smsto\Hubspot\Http\Controllers\SmstoController::class, 'send'])->name('hubspot.smsto.send');
    });

});
