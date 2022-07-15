<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'hubspot/admin', 'middleware' => ['web', config('hubspot.auth_middleware')]], function () {

    Route::prefix('/actions')->group(function () {
        Route::get('/', [\Smsto\Hubspot\Http\Controllers\Admin\ActionsController::class, 'index'])->name('hubspot.admin.actions.index');
        Route::get('/create', [\Smsto\Hubspot\Http\Controllers\Admin\ActionsController::class, 'create'])->name('hubspot.admin.actions.create');
        Route::post('/store', [\Smsto\Hubspot\Http\Controllers\Admin\ActionsController::class, 'store'])->name('hubspot.admin.actions.store');
        Route::get('/{action_id}/edit', [\Smsto\Hubspot\Http\Controllers\Admin\ActionsController::class, 'edit'])->name('hubspot.admin.actions.edit');
        Route::post('/{action_id}/update', [\Smsto\Hubspot\Http\Controllers\Admin\ActionsController::class, 'update'])->name('hubspot.admin.actions.update');
        Route::get('/{action_id}/archive', [\Smsto\Hubspot\Http\Controllers\Admin\ActionsController::class, 'archive'])->name('hubspot.admin.actions.archive');
    });

    Route::prefix('/settings')->group(function () {
        Route::any('/', [\Smsto\Hubspot\Http\Controllers\Admin\SettingsController::class, 'index'])->name('hubspot.admin.settings.index');
        Route::get('/show/{settings}', [\Smsto\Hubspot\Http\Controllers\Admin\SettingsController::class, 'show'])->name('hubspot.admin.settings.show');
        Route::post('/destroy/{settings}', [\Smsto\Hubspot\Http\Controllers\Admin\SettingsController::class, 'destroy'])->name('hubspot.admin.settings.destroy');
    });

});
