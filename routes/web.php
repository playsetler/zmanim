<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Cache::flush();
    return "Cache is cleared";
});

Route::get('/preview/{layout}/', [App\Http\Controllers\Layout\ShowLayoutController::class, 'get']);

Route::get('{catchall}', [App\Http\Controllers\AppController::class, 'index'])->where('catchall', '.*');