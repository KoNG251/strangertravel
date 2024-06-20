<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;

class OtpController extends Controller
{
    public function sendOtp()
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $from = env('TWILIO_FROM');

        function formatThaiPhoneNumber($number) {
            if (strpos($number, '0') === 0) {
                $formattedNumber = '+66' . substr($number, 1);
            } else {
                $formattedNumber = $number;
            }

            return $formattedNumber;
        }

        $user = User::where('id','=',session('user'))->first();

        if(is_null($user->tel) || $user->tel == ''){
            Alert::error('ผิดพลาด','กรุณากรอกเบอร์โทรศัพท์');
            return redirect()->route('profile');
        }else{
            $phone = formatThaiPhoneNumber($user->tel);

            $client = new Client($sid, $token);

            // Generate a -digit OTP
            $otp = rand(100000, 999999);

            $message = $client->messages->create(
                $phone,
                [
                    'from' => $from,
                    'body' => "Thank for verify in strangerTravel your OTP is: {$otp}"
                ]
            );

            session(['smsOtp'=>$otp]);

            return view('auth.phoneVerify')->with(['phone'=>$phone]);
        }
    }

    public function phoneVerify() {
        return view('auth.phoneVerify');
    }

    public function emailVerify() {
        return view('auth.emailVerify');
    }

    public function checkOtp(Request $request){

        $request->validate([
            'otp1'=>'required',
            'otp2'=>'required',
            'otp3'=>'required',
            'otp4'=>'required',
            'otp5'=>'required',
            'otp6'=>'required',
        ]);

        $otp = $request->otp1.$request->otp2.$request->otp3.$request->otp4.$request->otp5.$request->otp6 ;

        if(session('smsOtp') == $otp){
            $profile = User::where('id','=',session('user'))->first();
            $profile->otp_verify = "1";
            $profile->save();
            Alert::success('success','ทำการยืนยัน email เสร็จสิ้น');
            return redirect()->route('auth.authentication');
        }else{
            Alert::error('ผิดพลาด','กรุณากรอก OTP ใหม่');
            return view('auth.phoneVerify');
        }

    }

    public function checkEmailOtp(Request $request){

        $request->validate([
            'otp1'=>'required',
            'otp2'=>'required',
            'otp3'=>'required',
            'otp4'=>'required',
            'otp5'=>'required',
            'otp6'=>'required',
        ]);

        $otp = $request->otp1.$request->otp2.$request->otp3.$request->otp4.$request->otp5.$request->otp6 ;

        if(session('emailOtp') == $otp){
            $profile = User::where('id','=',session('user'))->first();
            $profile->email_verify = "1";
            $profile->save();
            Alert::success('success','verify successfully!');
            return redirect()->route('auth.authentication');
        }else{
            Alert::error('ผิดพลาด','กรุณากรอก OTP ใหม่');
            return view('auth.emailVerify');
        }

    }

}
