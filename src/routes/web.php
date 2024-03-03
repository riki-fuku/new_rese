<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\User\MypageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 一般ユーザールート
Route::middleware(['auth', 'verified'])->group(function () {

    // 店舗
    Route::get('/home', [ShopController::class, 'index'])->name('home');
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

    Route::prefix('/mypage')->name('mypage.')->group(function () {
        Route::get('/', [MypageController::class, 'index'])->name('index');
    });
});

// 一般ユーザー認証
require __DIR__ . '/auth.php';

// 管理者ルート
Route::prefix('admin')->name('admin.')->group(function () {

    // 管理者画面
    require __DIR__ . '/admin.php';

    // 管理者認証
    require __DIR__ . '/admin_auth.php';
});


// 店舗代表者ルート
Route::prefix('agent')->name('agent.')->group(function () {

    // 管理者画面
    require __DIR__ . '/agent.php';

    // 店舗代表者認証
    require __DIR__ . '/agent_auth.php';
});
