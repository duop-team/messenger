<?php

namespace App\Http\Controllers;

use App\Models\SmsCode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

class SmsCodeController extends Controller
{
    private function sendSms($code, $phone)
    {
        return Nexmo::message()->send([
            'to' => $phone,
            'from' => env('SMS_FROM'),
            'text' => 'Code: ' . $code
        ]);
    }

    private function generateCode()
    {
        return rand(11111, 99999);
    }

    public function store(Request $request)
    {
        $code = $this->generateCode();
        $this->sendSms($code, $request->phone);
        $token = session()->token();
        return SmsCode::create([
            'code' => $code,
            'created_at' => Carbon::now(),
            'valid_time' => Carbon::now()->addMinutes(10),
            'session' => $token
        ]);
    }

    public function edit(Request $request)
    {
        $smsCodes = SmsCode::findOrFail($request->user_id);
        $currentTime = Carbon::now();
        $created_at = Carbon::parse($smsCodes->created_at);
        if (($created_at->diffInMinutes($currentTime) >= 1) && $currentTime->lessThan(Carbon::parse($smsCodes->valid_time))) {
            $code = $this->generateCode();
            $this->sendSms($code, User::findOrFail($request->user_id)->phone);
            return $smsCodes->update([
                'code' => $code,
                'created_at' => Carbon::now(),
                'valid_time' => Carbon::now()->addMinutes(10),
                'session' => $request->session()->token()
            ]);
        }
        return response(['Error: something comes wrong']);
    }
}
