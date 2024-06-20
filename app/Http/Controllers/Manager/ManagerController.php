<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Chunk;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use App\Models\Photo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class ManagerController extends Controller
{

    public function register(Request $request) {

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

    public function login(Request $request) {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email',$request->input('email'))->where('user','manager')->first();

        if($user === null){
            return response()->json([
                'message' => 'User not found'
            ],500);
        }

        if(Hash::check($request->input('password'),$user->password)){

            session(['manager' => $user->id,'user' => $user->id, 'fname' => $user->fname, 'lname' => $user->lname, 'email' => $user->email]);

            return response()->json([
                "message" => "login successful",
                'url' => route('manager.cms.home')
            ]);

        }

    }

    public function logout() {
        Session::flush();

        return response()->json([
            'url' => route('manager.index')
        ]);

    }

    function updateDetail(Request $request) {

        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'gender' => 'required',
        ]);

        $user = User::find(session('manager'));

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

    function updatePassword(Request $request) {

        $request->validate([
            'current' => 'required',
            'password' => 'required|confirmed'
        ]);

        $user = User::find(session('manager'));

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

    public function getInfoHotel(Request $request) {

        $id = $request->input('id');

        $hotel = Hotel::find($id);

        if($hotel == null || is_null($hotel)){
            return response()->json([
                'message' => 'nice hacker',
                'url' => route('manager.cms.home')
            ],500);
        }

        $image = Photo::where('hotel',$id)->get();

        $rooms = Room::where('hotelId',$id)->orderBy('numberOfRoom')->get();

        return response()->json([
            'message' => [
                'hotel' => $hotel,
                'image' => $image,
                'room' => $rooms
            ]
        ]);

    }

    public function getInfoRoom(Request $request) {

        $id = $request->input('id');

        $rooms = Room::where('id','=',$id)->get();

        foreach ($rooms as $room) {
            $room->facilities = json_decode($room->facilities);
        }

        return response()->json([
            'message' => $rooms
        ]);

    }

}
