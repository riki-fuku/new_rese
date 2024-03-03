<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\User\MypageController;

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
    });
});
