<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ManagementAgentController;
use App\Http\Controllers\Admin\MailController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // 店舗代表者関連
    Route::prefix('management_agent')->name('management_agent.')->group(function () {
        Route::get('/', [ManagementAgentController::class, 'index'])->name('index');
    });

    // メール送信
    Route::prefix('mail')->name('mail.')->group(function () {
        Route::get('/', [MailController::class, 'index'])->name('index');
        Route::post('/send', [MailController::class, 'send'])->name('send');
    });
});
