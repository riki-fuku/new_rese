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
}
