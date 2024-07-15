<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Group;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Photo;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{

    public function user() {

        $all = User::count();

        $manager = User::where('user','=','manager')->count();

        $member = User::where('user','=','member')->count();

        return response()->json([
            'message' => [
                'all' => $all,
                'manager' => $manager,
                'member' => $member
            ]
        ]);

    }

    public function group() {

        $group = Group::count();

        return response()->json([
            'message' => $group
        ]);

    }

    public function booking() {

        $booking = Booking::where('status',1)->count();

        return response()->json([
            'message' => $booking
        ]);

    }

    public function hotel() {

        $hotel = Hotel::where('admin_check',1)->count();

        return response()->json([
            'message' => $hotel
        ]);

    }

    public function amount() {

        $amount = User::join('hotels', 'hotels.createId', '=', 'users.id')
        ->join('rooms', 'rooms.hotelId', '=', 'hotels.id')
        ->join('bookings', 'bookings.roomId', '=', 'rooms.id')
        ->leftJoin('transactions', 'transactions.bookingID', '=', 'bookings.id')
        ->groupBy('hotels.id', 'hotels.hotelName')
        ->selectRaw('hotels.hotelName as hotel, SUM(transactions.price) as total_price')
        ->get();


        return response()->json([
            'message' => $amount
        ]);
    }

    public function alluser() {
        $user = User::paginate(10);

        return response()->json([
            'message' => $user
        ]);

    }

    public function notVerifyHotel() {
        $hotel = Hotel::select('hotels.id', 'hotels.hotelName as name', 'hotels.province', DB::raw('GROUP_CONCAT(photos.photos) as photos'))
        ->join('photos', function ($join) {
            $join->on('hotels.id', '=', 'photos.hotel');
        })
        ->where('admin_check', 0)
        ->groupBy('hotels.id','hotels.hotelName','hotels.province')
        ->paginate(20);

        return response()->json([
            'message' => $hotel
        ]);
    }

    public function getInfoHotel(Request $request) {

        $id = $request->input('id');

        $hotel = Hotel::find($id);

        if($hotel == null || is_null($hotel)){
            return response()->json([
                'message' => 'nice hacker',
                'url' => route('admin.cms.hotel')
            ],500);
        }

        $image = Photo::where('hotel',$id)->get();

        $rooms = Room::where('hotelId',$id)->orderBy('numberOfRoom')->get();

        foreach ($rooms as $room) {
            $room->facilities = json_decode($room->facilities);
        }

        return response()->json([
            'message' => [
                'hotel' => $hotel,
                'image' => $image,
                'room' => $rooms
            ]
        ]);

    }


}
