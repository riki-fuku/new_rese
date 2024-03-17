<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        // 予約一覧を取得（キャンセル済以外のもののみ）
        $reservationShops = Reservation::with('shop')
            ->where('status', '!=', Reservation::CANCELED)
            ->where('status', '!=', Reservation::EVALUATED)
            ->orderBy('status', 'asc')
            ->orderBy('reservation_date', 'asc')
            ->orderBy('reservation_time', 'asc')
            ->get();

        return response()->json($reservationShops);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $reservation = Reservation::find($id);
        // statusをキャンセル(99)に変更
        $reservation->status = Reservation::CANCELED;
        $reservation->save();
        return response()->json($reservation);
    }

    public function detail($reservationId)
    {
        $reservation = Reservation::with('shop', 'user')->find($reservationId);
        return response()->json($reservation);
    }

    public function visited(Request $request)
    {
        $id = $request->reservation_id;
        $reservation = Reservation::find($id);
        // statusを来店済(2)に変更
        $reservation->status = Reservation::VISITED;
        $reservation->save();
        return response()->json($reservation);
    }
}
