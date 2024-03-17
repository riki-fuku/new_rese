<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index()
    {
        return view('agent.mail.index');
    }

    public function send(Request $request)
    {
        // メール送信処理
        return redirect()->route('agent.mail.index')->with('status', 'メールを送信しました');
    }
}
