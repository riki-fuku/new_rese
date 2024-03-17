<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\ShopUser;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index()
    {
        // 店舗一覧を取得
        $shops = Shop::all();
        return response()->json($shops);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // 店舗登録実行
            $shop = new Shop();
            $shop->name = $request->name;
            $shop->area_id = $request->area_id;
            $shop->genre_id = $request->genre_id;
            $shop->description = $request->description;
            $shop->capacity = $request->capacity;
            $shop->save();

            // 店舗代表者の店舗IDを更新実行
            $shop_user = ShopUser::find($request->user_id);
            $shop_user->shop_id = $shop->id;
            $shop_user->save();

            // TODO:ファイルアップロード未実装

            // // 店舗TOP画像アップロード
            // $file = $request->file('image');
            // // $file->storeAs('storage/app/image/1', 'top2.jpg');

            // // ファイルを保存
            // $path = $file->storeAs(
            //     'public/images',  // ディレクトリ
            //     time() . '.' . $file->getClientOriginalExtension()  // ファイル名
            // );

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => '店舗登録に失敗しました。'], 500);
        }

        return response()->json($shop);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            // 店舗更新実行
            $shop = Shop::find($request->id);
            $shop->name = $request->name;
            $shop->area_id = $request->area_id;
            $shop->genre_id = $request->genre_id;
            $shop->description = $request->description;
            $shop->capacity = $request->capacity;
            $shop->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => '店舗更新に失敗しました。'], 500);
        }

        return response()->json($shop);
    }


    public function show($id)
    {
        // 店舗詳細を取得
        $shop = Shop::with('genre', 'area')->find($id);
        return response()->json($shop);
    }
}
