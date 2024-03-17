<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    public function index($reservationId)
    {
        // ログインユーザーの情報取得
        $user = Auth::guard('agent')->user();
        $userShopId = $user->shop_id;

        // 予約IDより予約状況を取得
        $reservation = Reservation::with('shop', 'user')
            ->where('id', $reservationId)
            ->where('shop_id', $userShopId)
            ->first();

        // 予約情報が取得できない場合は店舗管理者用のホーム画面へリダイレクト
        if ($reservation === null) {
            return redirect()->route('agent.home');
        }

        $reservationId = $reservation->id;

        // 予約ステータス一覧を取得
        $status = Reservation::STATUS;

        return view('agent.visit.index', compact('reservationId', 'status'));
    }
}
