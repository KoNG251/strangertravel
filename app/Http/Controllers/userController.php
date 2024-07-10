<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecoverPassword;

class userController extends Controller
{

    public $profile;

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email',$request->input('email'))->where('user','member')->first();

        if($user === null){
            return response()->json([
                'message' => 'User not found'
            ],500);
        }

        if(Hash::check($request->input('password'),$user->password)){

            session(['user' => $user->id, 'fname' => $user->fname, 'lname' => $user->lname, 'email' => $user->email]);

            return response()->json([
                "message" => "login successful",
                'url' => route('index')
            ]);

        }else{
            return response()->json([
                'message' => 'Invalid password'
            ],500);
        }

    }

    public function userLogout()
    {
        alert()->success('Success!', 'Logout Successfully');
        Session::flush();
        return redirect()->route('index');
    }

    public function register(Request $request){

        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'gender' => 'required',
            'CitizenID' => 'required',
            'tel' => 'required|min:10|max:10',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'user' => 'required'
        ]);

        function Validate($citizenID) {
            $id_digits = str_split(str_replace('-', '', $citizenID));
            if (count($id_digits) !== 13) {
                return FALSE;
            }
            $sum = 0;
            for ($i = 0; $i < 12; $i++) {
                $sum += (int)$id_digits[$i] * (13 - $i);
            }
            $check_digit = (11 - ($sum % 11)) % 10;
            if ($check_digit != $id_digits[12]) {
                return FALSE;
            } else {
                return TRUE;
            }
        }

        if(!Validate($request->input('CitizenID'))){
            return response()->json([
                "message"=>'This citizen id wrong'
            ],500);
        }

        $countRow = User::count();
        if($countRow != 0){
            $checkCitizenID = User::pluck('citizenID');

            foreach($checkCitizenID as $id){
                if(Hash::check($request->input('CitizenID'),$id)){
                    $checkID = TRUE;
                    break;
                }else{
                    $checkID = FALSE;
                }
            }

            if($checkID){
                return response()->json([
                    "message"=>'This citizen id already has',
                ],500);
            }
        }

        $manager = User::create([
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'gender' => $request->input('gender'),
            'citizenID' => Hash::make($request->input('CitizenID')),
            'tel' => $request->input('tel'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'user' => $request->input('user')
        ]);

        return response()->json([
            "message"=> 'Sing-up successful!',
            'url' => route('manager.index')
        ],200);

    }

    public function updateRoute() {
        $auth = session('user');
        $userinfo = User::where('id','=',$auth)->first();
        return view('auth.update')->with(['user'=>$userinfo]);
    }

    public function updatePicture(Request $request) {

        $carbon = Carbon::now();
        $timestamp = $carbon->toDateTimeString();

        $request->validate([
            'avatar' => 'image',
        ]);

        $file = $request->file('avatar');

        $auth_id = session('user');
        $profile = User::find($auth_id);

        if($profile->userPicturePath == null){
            $newFileName = $auth_id . '_' . time() . '.' . $file->getClientOriginalExtension();
        }else{
            $newFileName = $profile->userPicturePath;
        }

        $folderPath = '/public/userProfiles/';
        Storage::disk('local')->put($folderPath . $newFileName, file_get_contents($file));

        if (Storage::disk('local')->exists($folderPath.$newFileName)) {

            $profile->userPicturePath = $newFileName;
            $profile->updated_at = $timestamp;
            $profile->save();

            if($profile){
                return response()->json([
                    "message"=>"Upload success",
                    "data" => [
                        "path" => $newFileName
                    ]
                ]);
            }

        }else{
            return response()->json([
                "message"=>"Upload fail"
            ]);
        }

    }

    public function updateDetail(Request $request){

        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'gender' => 'required',
        ]);

        $user = User::find(session('user'));

        $user->update([
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'gender' => $request->input('gender'),
            'birthdate' => $request->input('birthdate'),
        ]);

        if($user){
            return response()->json([
                'message' => 'update success'
            ]);
        }

        return response()->json([
            "message"=>"update fail"
        ],500);

    }

    public function updatepassword(Request $request) {

        $request->validate([
            'current' => 'required',
            'password' => 'required|confirmed'
        ]);

        $user = User::find(session('user'));

        if(!Hash::check($request->input('current'),$user->password)){
            return response()->json([
                'message' => 'Current password not match'
            ],500);
        }

        $user->update([
            'password' => Hash::make($request->input('password'))
        ]);

        if($user){
            return response()->json([
                'message' => 'update success'
            ]);
        }

    }

    public function deleteAccout(Request $request) {

        $auth = session('user');
        $user = User::find($auth);
        $user->status = '0';
        $user->save();

        if($user){
            Session::flush();
            return response()->json([
                "message" => "delete account successfully!"
            ]);
        }

    }

    public function viewAuth() {
        $auth = session('user');
        $userinfo = User::where('id','=',$auth)->first();
        return view('auth.authentication')->with(['user'=>$userinfo]);
    }

    public function viewLogin() {
        return view('login');
    }

    public function viewRegister() {
        return view('register');
    }

    public function viewRePassword() {
        return view('repassword');
    }

    public function viewReset(){
        return view('reset');
    }

    public function rePassword(Request $request) {

        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email',$request->input('email'))->first();

        if($user == null){
            return response()->json([
                "message" => 'User not found'
            ],500);
        }

        Mail::to($request->email)->send(new RecoverPassword($user->id,$user->email));

        return response()->json([
            "success"
        ]);


    }

    public function resetPassword(Request $request) {

        $request->validate([
            'email' => 'required|email',
            'id' => 'required',
            'password' => 'required|confirmed|min:8'
        ]);

        $user = User::where('email',$request->input('email'))->first();

        if($user == null){
            return response()->json([
                "message" => 'User not found'
            ],500);
        }

        if(!Hash::check($user->id,$request->id)){
            return response()->json([
                "message" => 'Invalid Token'
            ],500);
        }

        $user->update([
            'password' => Hash::make($request->input('password'))
        ]);

        return response()->json([
            'message' => "Password reset successfully. You can now login with your new password.",
            "url" => route('login')
        ]);

    }


}
