<?php

namespace App\Http\Controllers\APi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Rating;

class RatingController extends Controller
{
    /**
     * 店舗評価登録実行(axios)
     */
    public function store(Request $request)
    {
        // 評価登録実行
        $rating = new Rating();
        $rating->rating = $request->rating;
        $rating->shop_id = $request->shop_id;
        $rating->user_id = $request->user_id;
        $rating->save();

        // 予約情報を評価済みに更新
        $reservation = Reservation::find($request->reservation_id);
        $reservation->status = Reservation::EVALUATED;
        $reservation->save();

        return response()->json($rating);
    }
}
