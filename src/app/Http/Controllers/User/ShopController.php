<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;

class ShopController extends Controller
{

    /**
     * 店舗一覧画面
     */
    public function index()
    {
        $areas = Area::pluck('name', 'id');
        $genres = Genre::pluck('name', 'id');

        $shops = Shop::with('area', 'genre', 'favorite')->get();

        return view('user.shop.index', compact(['shops', 'areas', 'genres']));
    }

    /**
     * 店舗検索画面
     */
    public function search()
    {
        $areas = Area::pluck('name', 'id');
        $genres = Genre::pluck('name', 'id');

        // リクエスト取得
        $selectedArea = request('area');
        $selectedGenre = request('genre');
        $searchWord = (string)request('search');

        if (!empty($selectedArea) || !empty($selectedGenre) || !empty($searchWord)) {
            // クエリビルダ
            $query = Shop::query();

            if ($selectedArea != 0) {
                $query->where('area_id', $selectedArea);
            }

            if ($selectedGenre != 0) {
                $query->where('genre_id', $selectedGenre);
            }

            if ($searchWord != '') {
                $query->where(function ($query) use ($searchWord) {
                    $query->where('name', 'like', '%' . $searchWord . '%')
                        ->orWhere('description', 'like', '%' . $searchWord . '%');
                });
            }

            $shops = $query->get();
        } else {
            return redirect()->route('home');
        }

        return view('user.shop.index', compact(['shops', 'areas', 'genres', 'selectedArea', 'selectedGenre', 'searchWord']));
    }

    /**
     * 店舗詳細画面
     */
    public function detail($id)
    {
        $shop = Shop::find($id);
        return view('user.shop.detail', compact('shop'));
    }

    /**
     * 予約確認画面
     */
    public function confirm(Request $request)
    {
        return view('user.shop.confirm', compact('request'));
    }

    /**
     * 予約実行
     */
    public function store(Request $request)
    {
        // 予約処理
        $reservation = new Reservation();
        $reservation->shop_id = $request->shop_id;
        $reservation->user_id = auth()->id();
        $reservation->reservation_date = $request->reservation_date;
        $reservation->reservation_time = $request->reservation_time;
        $reservation->party_size = $request->party_size;
        $reservation->status = Reservation::RESERVED;
        $reservation->save();

        // 予約完了画面を表示
        $message = 'ご予約ありがとうございます';
        return redirect('/shop/complete')->with('message', $message);
    }

    /**
     * 完了画面
     */
    public function complete()
    {
        $message = session('message');
        if ($message == '') {
            redirect('/home');
        }
        return view('user.complete', compact('message'));
    }

    /**
     * 予約変更画面
     */
    public function edit($reservationId)
    {
        $reservationShop = Reservation::find($reservationId);

        // 予約情報がないもしくは、statusが予約済の場合は予約変更画面を表示
        if (!$reservationShop || $reservationShop->status != Reservation::RESERVED) {
            return redirect('/home');
        }

        return view('user.shop.edit', compact('reservationShop'));
    }

    /**
     * 予約変更確認画面
     */
    public function updateConfirm(Request $request)
    {
        return view('user.shop.update_confirm', compact('request'));
    }

    /**
     * 予約変更実行
     */
    public function update(Request $request)
    {
        // 予約更新処理
        $reservation = Reservation::find($request->id);
        $reservation->reservation_date = $request->reservation_date;
        $reservation->reservation_time = $request->reservation_time;
        $reservation->party_size = $request->party_size;
        $reservation->status = Reservation::RESERVED;
        $reservation->save();

        // 予約完了画面を表示
        $message = '予約変更が完了しました';
        return redirect('/shop/complete')->with('message', $message);
    }
}
