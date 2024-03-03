<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{
    public function index()
    {
        // 店舗一覧を取得
        $shops = Shop::all();
        return response()->json($shops);
    }
}
