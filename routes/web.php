<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrackerController;


Route::middleware(['auth', 'App\Http\Middleware\LoginMiddleware'])->group(function () {

    Route::get('/', [TrackerController::class, 'index'])
        ->name('tracker');

});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
