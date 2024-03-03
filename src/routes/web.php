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

//一般ユーザー
// 一般ユーザールート
require __DIR__ . '/user.php';

// 一般ユーザー認証
require __DIR__ . '/auth.php';

// 管理者
Route::prefix('admin')->name('admin.')->group(function () {

    // 管理者ルート
    require __DIR__ . '/admin.php';

    // 管理者認証
    require __DIR__ . '/admin_auth.php';
});


// 店舗代表者
Route::prefix('agent')->name('agent.')->group(function () {

    // 店舗代表者ルート
    require __DIR__ . '/agent.php';

    // 店舗代表者認証
    require __DIR__ . '/agent_auth.php';
});
