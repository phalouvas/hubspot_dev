<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'hubspot', 'middleware' => 'web'], function () {

    Route::get('/', function () {
        return view('hubspot::welcome');
    })->name('hubspot.web.home');

    Route::get('/error', [\Smsto\Hubspot\Http\Controllers\Web\HubspotController::class, 'error'])->name('hubspot.web.error');

    Route::prefix('/gui')->group(function () {
        Route::get('/', [\Smsto\Hubspot\Http\Controllers\Web\HubspotController::class, 'index'])->name('hubspot.web.gui');
        Route::get('/iframe', [\Smsto\Hubspot\Http\Controllers\Web\HubspotController::class, 'iframe'])->name('hubspot.web.gui.iframe');
    });

    Route::prefix('/settings')->group(function () {
        Route::get('/create', [\Smsto\Hubspot\Http\Controllers\Web\SettingsController::class, 'create'])->name('hubspot.web.settings.create');
        Route::post('/store', [\Smsto\Hubspot\Http\Controllers\Web\SettingsController::class, 'store'])->name('hubspot.web.settings.store');
        Route::get('/completed/{settings}', [\Smsto\Hubspot\Http\Controllers\Web\SettingsController::class, 'completed'])->name('hubspot.web.settings.completed');
        Route::get('/edit/{settings}', [\Smsto\Hubspot\Http\Controllers\Web\SettingsController::class, 'edit'])->name('hubspot.web.settings.edit');
        Route::post('/update/{settings}', [\Smsto\Hubspot\Http\Controllers\Web\SettingsController::class, 'update'])->name('hubspot.web.settings.update');
    });
});
