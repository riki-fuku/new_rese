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

//  店舗お気に入り登録
Route::post('/favorite', 'App\Http\Controllers\User\FavoriteController@store')->name('favorite.store');

//  店舗予約一覧取得
Route::get('/reservations', 'App\Http\Controllers\User\ReservationController@index')->name('reservation.index');

//  店舗予約削除
Route::delete('/reservations/{id}', 'App\Http\Controllers\User\ReservationController@destroy')->name('reservation.destroy');

//  店舗評価登録
Route::post('/ratings', 'App\Http\Controllers\User\RatingController@store')->name('rating.store');
