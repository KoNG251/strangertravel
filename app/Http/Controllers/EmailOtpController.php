<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

class EmailOtpController extends Controller
{
    public function sendOtp()
    {

        $user = User::where('id','=',session('user'))->firstOrFail();

        $otp = rand(100000, 999999);

        session(['emailOtp'=>$otp]);

        Mail::to($user->email)->send(new TestEmail($otp));

        return view('auth.emailVerify');

    }
}
