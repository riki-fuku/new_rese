<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('home');

require __DIR__ . '/auth.php';

// 管理者ルート
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/home', function () {
        return view('admin.dashboard');
    })->middleware(['auth:admin', 'verified'])->name('home');

    require __DIR__ . '/admin.php';
});


// 店舗代表者ルート
Route::prefix('agent')->name('agent.')->group(function () {

    Route::get('/home', function () {
        return view('agent.dashboard');
    })->middleware(['auth:agent', 'verified'])->name('home');

    require __DIR__ . '/agent.php';
});
