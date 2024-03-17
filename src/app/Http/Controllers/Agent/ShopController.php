<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        // ログインユーザーの情報取得
        $user = Auth::guard('agent')->user();
        $userShopId = $user->shop_id;

        // ログインしているユーザーに店舗IDが紐づいていない場合は店舗作成画面へリダイレクト
        if (is_null($userShopId)) {
            return redirect()->route('agent.shop.create');
        }

        return view('agent.home.index', compact('userShopId'));
    }

    public function create()
    {
        // ログインユーザーの情報取得
        $user = Auth::guard('agent')->user();

        // ログインしているユーザーに店舗IDが紐づいている場合は店舗代表者HOME画面へリダイレクト
        if (!is_null($user->shop_id)) {
            return redirect()->route('agent.home');
        }

        return view('agent.shop.create');
    }

    public function edit($id)
    {
        // ログインユーザーの情報取得
        $user = Auth::guard('agent')->user();
        $userShopId = $user->shop_id;

        // ログインしているユーザーに店舗IDが紐づいていない場合は店舗作成画面へリダイレクト
        if (is_null($userShopId)) {
            return redirect()->route('agent.shop.create');
        }

        return view('agent.shop.edit', compact('userShopId'));
    }

    public function qrCode()
    {
        // ログインユーザーの情報取得
        $user = Auth::guard('agent')->user();

        // ログインしているユーザーに店舗IDが紐づいていない場合は店舗作成画面へリダイレクト
        if (is_null($user->shop_id)) {
            return redirect()->route('agent.shop.create');
        }

        // QRコード用のURLを生成
        $paymentUrl = route('payment.index', ['shopId' => $user->shop_id]);
        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . $paymentUrl;

        return view('agent.shop.qr_code', compact('qrCodeUrl'));
    }
}
