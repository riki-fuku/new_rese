<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * 店舗関連
 */
// 店舗一覧取得
Route::get('/shops', 'App\Http\Controllers\Api\ShopController@index')->name('shop.index');

// 地域一覧取得
Route::get('/areas', 'App\Http\Controllers\Api\AreaController@index')->name('area.index');

// ジャンル一覧取得
Route::get('/genres', 'App\Http\Controllers\Api\GenreController@index')->name('genre.index');

// 店舗詳細取得
Route::get('/shops/show/{id}', 'App\Http\Controllers\Api\ShopController@show')->name('shop.show');

// 店舗登録
Route::post('/shops', 'App\Http\Controllers\Api\ShopController@store')->name('shop.store');

// 店舗更新
Route::post('/shops/update', 'App\Http\Controllers\Api\ShopController@update')->name('shop.update');


/**
 * 予約関連
 */
// 店舗お気に入り登録
Route::post('/favorite', 'App\Http\Controllers\Api\FavoriteController@store')->name('favorite.store');

// 店舗予約一覧取得
Route::get('/reservations', 'App\Http\Controllers\Api\ReservationController@index')->name('reservation.index');

// 店舗予約削除
Route::delete('/reservations/{id}', 'App\Http\Controllers\Api\ReservationController@destroy')->name('reservation.destroy');

// 予約状況取得
Route::get('/agent/reservations/detail/{reservationId}', 'App\Http\Controllers\Api\ReservationController@detail')->name('reservation.detail');

// 予約ステータスを来店済に更新
Route::post('/agent/reservations/visited', 'App\Http\Controllers\Api\ReservationController@visited')->name('reservation.visited');


/**
 * 店舗評価関連
 */
// 店舗評価登録
Route::post('/ratings', 'App\Http\Controllers\Api\RatingController@store')->name('rating.store');


/**
 * 店舗代表者関連
 */
// 店舗代表者一覧取得
Route::get('/shop_users', 'App\Http\Controllers\Api\ShopUserController@index')->name('shop_user.index');

// 店舗代表者詳細取得
Route::get('/shop_users/show/{id}', 'App\Http\Controllers\Api\ShopUserController@show')->name('shop_user.show');

// 店舗代表者作成
Route::post('/shop_users/store', 'App\Http\Controllers\Api\ShopUserController@store')->name('shop_user.store');

// 店舗代表者更新
Route::post('/shop_users/update', 'App\Http\Controllers\Api\ShopUserController@update')->name('shop_user.update');

// 店舗代表者有効/無効切り替え
Route::post('/shop_users/change_invalid', 'App\Http\Controllers\Api\ShopUserController@changeInvalid')->name('shop_user.change_invalid');


/**
 * メール関連
 */
// Emailテンプレート取得
Route::get('/email_templates/{userType}', 'App\Http\Controllers\Api\EmailTemplateController@index')->name('email_template.index');

// Email送信(管理者用)
Route::post('/admin/send_email', 'App\Http\Controllers\Api\SendEmailController@adminStore')->name('send_email.admin_store');

// Email送信(店舗代表者用)
Route::post('/agent/send_email', 'App\Http\Controllers\Api\SendEmailController@agentStore')->name('send_email.agent_store');
