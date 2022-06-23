<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'middleware' => 'web', 'middleware' => 'auth.basic'], function () {

    Route::get('/', function () {
        return view('hubspot::home');
    })->name('login');

    Route::prefix('/actions')->group(function () {
        Route::get('/', [\Smsto\Hubspot\Http\Controllers\ActionsController::class, 'index'])->name('hubspot.admin.actions.index');
        Route::get('/create', [\Smsto\Hubspot\Http\Controllers\ActionsController::class, 'create'])->name('hubspot.admin.actions.create');
        Route::post('/store', [\Smsto\Hubspot\Http\Controllers\ActionsController::class, 'store'])->name('hubspot.admin.actions.store');
        Route::get('/{action_id}/edit', [\Smsto\Hubspot\Http\Controllers\ActionsController::class, 'edit'])->name('hubspot.admin.actions.edit');
        Route::post('/{action_id}/update', [\Smsto\Hubspot\Http\Controllers\ActionsController::class, 'update'])->name('hubspot.admin.actions.update');
        Route::post('/{action_id}/update', [\Smsto\Hubspot\Http\Controllers\ActionsController::class, 'update'])->name('hubspot.admin.actions.update');
        Route::get('/{action_id}/archive', [\Smsto\Hubspot\Http\Controllers\ActionsController::class, 'archive'])->name('hubspot.admin.actions.archive');
    });

});
