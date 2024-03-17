<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index($shopId)
    {
        // 対象の店舗IDの予約情報が来店中のステータスで存在するか確認
        $reservation = Reservation::with('shop')
            ->where('shop_id', $shopId)
            ->where('user_id', auth()->id())
            ->where('status', Reservation::VISITED)
            ->first();

        // 存在しない場合はマイページへリダイレクト
        if (is_null($reservation)) {
            return redirect()->route('mypage.index');
        }

        return view('user.payment.index', compact('reservation'));
    }

    public function store(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.stripe_secret_key'));

        $shopId = $request->shop_id;
        $userId = auth()->id();
        $amount = $request->amount;
        $stripeToken = $request->input('stripeToken');

        // 対象の店舗IDの予約情報が来店中のステータスで存在するか確認
        $reservation = Reservation::with('shop')
            ->where('shop_id', $shopId)
            ->where('user_id', $userId)
            ->where('status', Reservation::VISITED)
            ->first();

        // 存在しない場合はマイページへリダイレクト
        if (is_null($reservation)) {
            \Log::error('予約情報が存在しません。');
            return redirect()->route('mypage.index');
        }

        DB::beginTransaction();
        try {
            // // TODO::決済処理(Stripe)
            // $charge = \Stripe\Charge::create([
            //     'amount' => $amount,
            //     'currency' => 'jpy',
            //     'source' => $stripeToken,
            //     'description' => '予約ID: ' . $reservation->id,
            // ]);

            // 決済情報を保存
            $payment = new Payment();
            $payment->reservation_id = $reservation->id;
            $payment->payment_date = Carbon::now();
            $payment->amount = $amount;
            $payment->payment_method = Payment::CREDIT;
            $payment->payment_status = Payment::PAID;
            $payment->save();

            // 予約情報のステータスを予約済みに変更
            $reservation->status = Reservation::PAYMENT_COMPLETED;
            $reservation->save();

            DB::commit();
        } catch (\Exception $e) {
            \Log::error($e);

            DB::rollBack();
            return back()->withInput($request->only('card_number', 'card_expiry', 'amount'))
                ->with('error_message', '決済に失敗しました。もう一度やり直してください。');
        }

        // 予約完了画面を表示
        $message = $amount . "円の決済が完了しました。ご利用ありがとうございました。";
        return redirect('/shop/complete')->with('message', $message);
    }
}
