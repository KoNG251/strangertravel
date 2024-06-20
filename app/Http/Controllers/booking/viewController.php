<?php

namespace App\Http\Controllers\booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class viewController extends Controller
{

    public function viewInformation(Request $request) {
        $id = $request->input('id');

        $item = Hotel::select('hotels.*', DB::raw('GROUP_CONCAT(photos.photos) AS photos'))
        ->join('photos', 'hotels.id', '=', 'photos.hotel')
        ->where('hotels.id', '=', $id)
        ->groupBy('hotels.id','hotels.hotelName','hotels.createId','hotels.near','hotels.province','hotels.facilities','hotels.amphures','hotels.address','hotels.about','hotels.admin_check','hotels.created_at','hotels.updated_at')
        ->get();

        if($request->has('start') && $request->has('end')){
            $start = $request->input('start');
            $end = $request->input('end');
            $rooms = Room::query()
            ->select('id', 'numberOfRoom', 'room_type', 'price', 'numberOfBed', 'bed_type', DB::raw('COUNT(*) as count_room'))
            ->where('hotelId', $id)
            ->whereDoesntHave('bookings', function ($query) use ($start, $end) {
                $query->where('check_in', '<', $end)
                    ->where('check_out', '>', $start);
            })
            ->groupBy('id', 'numberOfRoom', 'room_type', 'price', 'numberOfBed', 'bed_type')
            ->get();
        }else{
            $rooms = Room::query()
            ->select('id', 'numberOfRoom', 'room_type', 'price', 'numberOfBed', 'bed_type', DB::raw('COUNT(*) as count_room'))
            ->where('hotelId', $id)
            ->whereDoesntHave('bookings', function ($query) {
                $query->where('check_in', '<', today()->addDay())
                    ->where('check_out', '>', today());
            })
            ->groupBy('id', 'numberOfRoom', 'room_type', 'price', 'numberOfBed', 'bed_type')
            ->get();
        }

        $count = $rooms->count();

        return view('information')->with(['item'=>$item,'rooms'=>$rooms,'count'=>$count]);
    }

    public function bookingInformation(Request $request) {

        if(session('user') == null || empty(session('user'))){
            $user = null;
        }else{
            $user = User::find(session('user'));
        }

        $hotel = Hotel::find($request->input('id'));

        $room = explode(',',$request->input('room'));

        $roomList = Room::whereIn('id',$room)->get();

        return view('booking')->with(['user'=>$user,'hotel'=>$hotel,'rooms'=>$roomList]);

    }

    public function viewPayment() {
        return view('payment');
    }

    public function viewSuccess(){
        return view('success');
    }

}
