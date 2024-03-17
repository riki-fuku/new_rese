<?php

use App\Http\Controllers\Agent\ShopController;
use App\Http\Controllers\Agent\MailController;
use App\Http\Controllers\Agent\VisitController;
use App\Http\Controllers\Agent\ReservationController;
use Illuminate\Support\Facades\Route;

// 店舗代表者ルート
Route::middleware(['auth:agent'])->group(function () {
    // Home
    Route::get('/', [ShopController::class, 'index'])->name('home');

    // 店舗
    Route::prefix('shop')->name('shop.')->group(function () {
        // 店舗作成画面
        Route::get('/create', [ShopController::class, 'create'])->name('create');

        // 店舗編集画面
        Route::get('/edit/{id}', [ShopController::class, 'edit'])->name('edit');

        // 店舗QR決済用QRコード表示画面
        Route::get('/qr_code', [ShopController::class, 'qrCode'])->name('qr_code');
    });

    // 予約
    Route::prefix('reservation')->name('reservation.')->group(function () {
        Route::get('/', [ReservationController::class, 'index'])->name('index');
    });

    // メール送信
    Route::prefix('mail')->name('mail.')->group(function () {
        Route::get('/', [MailController::class, 'index'])->name('index');
        Route::post('/send', [MailController::class, 'send'])->name('send');
    });

    // 来店確認画面
    Route::prefix('visit')->name('visit.')->group(function () {
        Route::get('/{reservationId}', [VisitController::class, 'index'])->name('index');
    });
});
