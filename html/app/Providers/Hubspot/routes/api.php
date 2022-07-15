<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'hubspot/api', 'middleware' => 'api', 'hubspot'], function () {

    Route::prefix('/smsto')->group(function () {
        Route::get('/{settings}/params', [\Smsto\Hubspot\Http\Controllers\Api\SmstoController::class, 'params'])->name('hubspot.api.smsto.params');
        Route::any('/{settings}/call', [\Smsto\Hubspot\Http\Controllers\Api\SmstoController::class, 'call'])->name('hubspot.api.smsto.call');
        Route::any('/send', [\Smsto\Hubspot\Http\Controllers\Api\SmstoController::class, 'send'])->name('hubspot.api.smsto.send');
    });

    Route::prefix('/settings')->group(function () {
        Route::get('/fetch', [\Smsto\Hubspot\Http\Controllers\Api\SettingsController::class, 'fetch'])->name('hubspot.api.settings.fetch');
        Route::get('/edit', [\Smsto\Hubspot\Http\Controllers\Api\SettingsController::class, 'edit'])->name('hubspot.api.settings.edit');
    });

    Route::prefix('/cards')->group(function () {
        Route::get('/', [\Smsto\Hubspot\Http\Controllers\Api\CardsController::class, 'index'])->name('hubspot.api.cards.index');
    });

});
