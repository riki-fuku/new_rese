<?php

use App\Http\Controllers\Agent\HomeController;
use Illuminate\Support\Facades\Route;

// 店舗代表者ルート
Route::middleware(['auth:agent'])->name('agent.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});
