<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'hubspot', 'middleware' => 'web'], function () {

    Route::get('/', function () {
        return view('hubspot::welcome');
    })->name('hubspot.home');

    Route::get('/error', [\Smsto\Hubspot\Http\Controllers\HubspotController::class, 'error'])->name('hubspot.error');

    Route::prefix('/gui')->group(function () {
        Route::get('/', [\Smsto\Hubspot\Http\Controllers\HubspotController::class, 'index'])->name('hubspot');
        Route::get('/iframe', [\Smsto\Hubspot\Http\Controllers\HubspotController::class, 'iframe'])->name('hubspot.iframe');
    });

    Route::prefix('/settings')->group(function () {
        Route::get('/create', [\Smsto\Hubspot\Http\Controllers\SettingsController::class, 'create'])->name('hubspot.settings.create');
        Route::post('/store', [\Smsto\Hubspot\Http\Controllers\SettingsController::class, 'store'])->name('hubspot.settings.store');
        Route::get('/completed/{settings}', [\Smsto\Hubspot\Http\Controllers\SettingsController::class, 'completed'])->name('hubspot.settings.completed');
        Route::get('/edit', [\Smsto\Hubspot\Http\Controllers\SettingsController::class, 'edit'])->name('hubspot.settings.edit');
        Route::post('/update/{settings}', [\Smsto\Hubspot\Http\Controllers\SettingsController::class, 'update'])->name('hubspot.settings.update');
    });
});
