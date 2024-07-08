<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;

class calculateController extends Controller
{
    public function index()  {
        return view('calculate');
    }

    public function viewResults(){
        return view('results');
    }

    public function calculate(Request $request) {

        $request->validate([
            'budget' => 'required|numeric',
            'start' => 'required',
            'end' => 'required',
            'province' => 'required',
            'adults' => 'required',
            'children' => 'required'
        ], [
            'budget.required' => 'Please input the budget.',
            'budget.numeric' => 'The budget must be a number.',
            'start.required' => 'Please input the start date.',
            'end.required' => 'Please input the end date.',
            'province.required' => 'Please input the province.',
            'adults.required' => 'Please input the number of adults.',
            'children.required' => 'Please input the number of children.'
        ]);

        if($request->input('budget') == 0){
            return response()->json([
                'message' => 'please input budget'
            ],500);
        }

        $sumday = date_diff(date_create($request->input('start')), date_create($request->input('end')));

        $perday = $request->input('budget')/$sumday->format("%a");

        $start = $request->input('start');
        $end = $request->input('end');

        $province = $request->input('province');
        $totalPeople = $request->input('adults')+$request->input('children');

        $hotels = DB::table('hotels')
        ->leftJoin('photos', 'hotels.id', '=', 'photos.hotel')
        ->leftJoin('rooms', 'rooms.hotelId', '=', 'hotels.id')
        ->select('hotels.id', 'hotels.hotelName', 'hotels.province',
            DB::raw("GROUP_CONCAT(DISTINCT photos.photos SEPARATOR ',') AS photos"))
        ->where(function ($query) use ($province) {
            $query->where('hotels.address', 'LIKE', "%$province%")
                ->orWhere('hotels.hotelName', 'LIKE', "%$province%")
                ->orWhere('hotels.province', 'LIKE', "%$province%")
                ->orWhere(function ($query) use ($province) {
                    for ($i = 0; $i <= 10; $i++) {
                        $query->orWhere(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(hotels.near, '$[$i]'))"), 'LIKE', "%$province%");
                    }
                });
        })
        ->where('rooms.price', '<=', $perday)
        ->whereExists(function ($query) use ($totalPeople) {
            $query->select(DB::raw(1))
                ->from('rooms')
                ->whereColumn('rooms.hotelId', 'hotels.id')
                ->whereRaw('rooms.numberOfBed * rooms.bed_type >= ?',[$totalPeople]);
        })
        ->groupBy('hotels.id', 'hotels.hotelName', 'hotels.province')
        ->get();



        return response()->json([
            'message' => [
                'date' => [
                    'checkin' => $request->input('start'),
                    'checkout' => $request->input('end'),
                    'sumday' => $sumday->format("%a")
                ],
                'guest' => [
                    'adult' => $request->input('adults'),
                    'child' => $request->input('children'),
                ],
                'price' => [
                    'budget' => $request->input('budget'),
                    'perday' => $perday,
                ],
                'item' => [
                    'hotels' => $hotels
                ]
            ]
        ]);

    }

}
