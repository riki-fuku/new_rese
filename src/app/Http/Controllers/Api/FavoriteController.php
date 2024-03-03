<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    /**
     * お気に入り登録(axios)
     * 登録済みの場合は削除、未登録の場合は登録
     */
    public function store(Request $request)
    {
        // リクエスト取得
        $shopId = $request->shopId;
        $userId = $request->userId;
        $favoriteFlg = $request->favoriteFlg;

        if (!$favoriteFlg) {
            // 登録処理
            Favorite::create([
                'shop_id' => $shopId,
                'user_id' => $userId,
            ]);
        } else {
            // 削除処理
            Favorite::where('shop_id', $shopId)->where('user_id', $userId)->delete();
        }

        // 成功レスポンス
        return response()->json(['success' => 'お気に入り登録しました']);
    }
}
