<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;

class indexController extends Controller
{
    public function index(Request $request){

        if(!$request->query()){

            $query = Hotel::select('hotels.id', 'hotels.hotelName as name', 'hotels.province', DB::raw('GROUP_CONCAT(photos.photos SEPARATOR ",") as photos'))
            ->leftJoin('photos', 'hotels.id', '=', 'photos.hotel')
            ->groupBy('hotels.id', 'hotels.hotelName', 'hotels.province')
            ->orderBy('hotels.hotelName')
            ->where('admin_check',1)
            ->paginate(20);

        }else{

            $province = $request->query('place');
            $query = Hotel::select(
                'hotels.id',
                'hotels.hotelName as name',
                'hotels.province',
                DB::raw('GROUP_CONCAT(photos.photos SEPARATOR ",") as photos'),
                'hotels.near'
            )
            ->leftJoin('photos', 'hotels.id', '=', 'photos.hotel')
            ->where(function($query) use ($province) {
                $query->where('address', 'LIKE', "%$province%")
                    ->orWhere('hotelName', 'LIKE', "%$province%")
                    ->orWhere('province', 'LIKE', "%$province%")
                    ->orWhere(function($query) use ($province) {
                        for ($i = 0; $i <= 10; $i++) {
                            $query->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(near, '$[$i]')) LIKE '%$province%'");
                        }
                    });
            })
            ->where('admin_check', 1)
            ->orderBy('hotels.hotelName')
            ->groupBy('hotels.id', 'hotels.hotelName', 'hotels.province','hotels.near')
            ->paginate(20);

        }

        return view('index')->with(['query'=>$query]);
    }
}
