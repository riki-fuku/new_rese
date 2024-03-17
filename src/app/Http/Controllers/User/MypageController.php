<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Reservation;

class MypageController extends Controller
{
    public function index()
    {
        $status = Reservation::STATUS;
        $favoriteShops = Favorite::with('shop')->get();
        return view('user.mypage.index', compact('status', 'favoriteShops'));
    }

    public function qrCode($reservationId)
    {
        $reservation = Reservation::where('id', $reservationId)
            ->where('user_id', auth()->id())
            ->where('status', Reservation::RESERVED) // 予約済みのものだけ取得
            ->first();

        // 予約情報がない場合はマイページにリダイレクト
        if (empty($reservation)) {
            return redirect()->route('mypage.index');
        }

        // QRコード用のURLを生成
        $reservationUrl = route('agent.visit.index', ['reservationId' => $reservationId]);
        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . $reservationUrl;

        return view('user.mypage.qr_code', compact('qrCodeUrl'));
    }
}
