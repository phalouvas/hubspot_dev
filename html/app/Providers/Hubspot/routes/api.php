<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'hubspot', 'middleware' => 'api'], function () {

    Route::prefix('/settings')->group(function () {
        Route::get('/', [\Smsto\Hubspot\Http\Controllers\SettingsController::class, 'index'])->name('hubspot.settings');
        Route::get('/create', [\Smsto\Hubspot\Http\Controllers\SettingsController::class, 'create'])->name('hubspot.settings.create');
        Route::post('/store', [\Smsto\Hubspot\Http\Controllers\SettingsController::class, 'store'])->name('hubspot.settings.store');
        Route::get('/show/{settings}', [\Smsto\Hubspot\Http\Controllers\SettingsController::class, 'show'])->name('hubspot.settings.show');
        Route::get('/edit/{settings}', [\Smsto\Hubspot\Http\Controllers\SettingsController::class, 'edit'])->name('hubspot.settings.edit');
        Route::post('/update/{settings}', [\Smsto\Hubspot\Http\Controllers\SettingsController::class, 'update'])->name('hubspot.settings.update');
        Route::delete('/destroy/{settings}', [\Smsto\Hubspot\Http\Controllers\SettingsController::class, 'destroy'])->name('hubspot.settings.destroy');
    });

    Route::prefix('/smsto')->group(function () {
        Route::get('/params', [\Smsto\Hubspot\Http\Controllers\SmstoController::class, 'params'])->name('hubspot.smsto.params');
        Route::any('/call', [\Smsto\Hubspot\Http\Controllers\SmstoController::class, 'call'])->name('hubspot.smsto.call');
    });

});
