<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\User\MypageController;
use App\Http\Controllers\User\PaymentController;

// 一般ユーザールート
Route::middleware(['auth', 'verified'])->group(function () {
    // 店舗
    Route::get('/', [ShopController::class, 'index'])->name('home');
    Route::get('/search', [ShopController::class, 'search'])->name('search');
    Route::prefix('/shop')->name('shop.')->group(function () {
        Route::get('/detail/{id}', [ShopController::class, 'detail'])->name('detail');
        Route::post('/', [ShopController::class, 'confirm'])->name('confirm');
        Route::post('/store', [ShopController::class, 'store'])->name('reservation');
        Route::get('/edit/{reservationId}', [ShopController::class, 'edit'])->name('edit');
        Route::post('/update/confirm', [ShopController::class, 'updateConfirm'])->name('update_confirm');
        Route::post('/update', [ShopController::class, 'update'])->name('update');
        Route::get('/complete', [ShopController::class, 'complete'])->name('complete'); // 共通完了画面
    });

    // Mypage
    Route::prefix('/mypage')->name('mypage.')->group(function () {
        Route::get('/', [MypageController::class, 'index'])->name('index');
        // 予約QRコード表示画面
        Route::get('/qr_code/{reservationId}', [MypageController::class, 'qrCode'])->name('qr_code');
    });

    // 決済画面
    Route::prefix('/payment')->name('payment.')->group(function () {
        Route::get('/{shopId}', [PaymentController::class, 'index'])->name('index');
        Route::post('/store', [PaymentController::class, 'store'])->name('store');
    });
});
