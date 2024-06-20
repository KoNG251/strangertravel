<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class dashboardManageController extends Controller
{
    public function dashboardInformation(Request $request) {

        $auth = session('manager');

        $bookingToday = User::select('bookings.*')
        ->join('hotels', 'hotels.createId', '=', 'users.id')
        ->join('rooms','rooms.hotelId','=','hotels.id')
        ->rightJoin('bookings','bookings.roomId','=','rooms.id')
        ->where('users.id', '=', $auth)
        ->whereDate('bookings.created_at', '=', date('Y-m-d'))
        ->count();

        $amountPrice = User::
        join('hotels', 'hotels.createId', '=', 'users.id')
        ->join('rooms','rooms.hotelId','=','hotels.id')
        ->join('bookings','bookings.roomId','=','rooms.id')
        ->rightJoin('transactions','transactions.bookingID','=','bookings.id')
        ->where('users.id', '=', $auth)
        ->sum('transactions.price');

        $chart = User::join('hotels', 'hotels.createId', '=', 'users.id')
        ->join('rooms', 'rooms.hotelId', '=', 'hotels.id')
        ->join('bookings', 'bookings.roomId', '=', 'rooms.id')
        ->rightJoin('transactions', 'transactions.bookingID', '=', 'bookings.id')
        ->where('users.id', '=', $auth)
        ->whereBetween('transactions.created_at', [Carbon::now()->subWeek(), Carbon::now()])
        ->groupBy(DB::raw('DATE(transactions.created_at)'))
        ->selectRaw('DATE(transactions.created_at) as date, SUM(transactions.price) as total_price')
        ->get();

        $checkInToday = Hotel::select('bookings.*','rooms.numberOfRoom as room')
        ->join('rooms','rooms.hotelId','=','hotels.id')
        ->join('bookings','bookings.roomId','=','rooms.id')
        ->where('hotels.createId', '=', $auth)
        ->whereDate('bookings.check_in', '=', date('Y-m-d'))
        ->get();

        $checkOutToday = Hotel::select('bookings.*','rooms.numberOfRoom as room')
        ->join('rooms','rooms.hotelId','=','hotels.id')
        ->join('bookings','bookings.roomId','=','rooms.id')
        ->where('hotels.createId', '=', $auth)
        ->whereDate('bookings.check_out', '=', date('Y-m-d'))
        ->get();

        $allRoomCount = Hotel::join('rooms','rooms.hotelId','=','hotels.id')
        ->where('hotels.createId','=',$auth)
        ->count();

        $allHotelCount = Hotel::where('hotels.createId','=',$auth)
        ->count();

        return response()->json([
            'message' => [
                'bookingToday' => $bookingToday,
                'amountPrice' => $amountPrice,
                'checkInToday' => $checkInToday,
                'checkOutToday' => $checkOutToday,
                'allRoomCount' => $allRoomCount,
                'allHotelCount' => $allHotelCount,
                'chart' => $chart
            ]
        ]);

    }
}
