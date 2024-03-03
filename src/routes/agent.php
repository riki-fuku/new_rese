<?php

use App\Http\Controllers\Agent\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:agent'])->name('agent.')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
