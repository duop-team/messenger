<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

class SmsCodeController extends Controller
{
    public function sendSms(Request $request)
    {
        $code = rand(0000, 9999);
        Nexmo::message()->send([
            'to'   => $request->phone,
            'from' => env('SMS_FROM'),
            'text' => 'Code: ' . $code
        ]);
        $user = User::findOrFail($request->user_id);
        $user->sms_codes()->create([
            'code' => $code,
            'created_at' => Carbon::now('Europe/Kiev'),
            'valid_time' => Carbon::now('Europe/Kiev')->addMinutes(10),
            'timeout' => Carbon::now('Europe/Kiev')->addMinute()
        ]);
    }
}
