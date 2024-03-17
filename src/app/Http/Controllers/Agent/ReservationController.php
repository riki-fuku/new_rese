<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        // ログインユーザーの情報取得
        $user = Auth::guard('agent')->user();
        $userShopId = $user->shop_id;

        // 店舗ユーザーに紐づく予約情報を取得
        $reservationList = Reservation::with('user')
            ->where('shop_id', $userShopId)
            ->orderBy('reservation_date', 'desc')
            ->orderBy('reservation_time', 'asc')
            ->orderBy('status', 'asc')
            ->get();

        $status = Reservation::STATUS;

        return view('agent.reservation.index', compact('reservationList', 'status'));
    }
}
