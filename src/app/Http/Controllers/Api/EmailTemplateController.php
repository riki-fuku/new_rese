<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;

class EmailTemplateController extends Controller
{
    public function index($userType)
    {
        $emailTemplateList = EmailTemplate::where('user_type', $userType)->get();
        return response()->json($emailTemplateList, 200);
    }
}
