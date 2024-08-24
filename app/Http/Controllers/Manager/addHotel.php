<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Chunk;
use App\Models\Hotel;
use App\Models\Photo;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class addHotel extends Controller
{

    public function chunksfile(Request $request) {

        $request->validate([
            'file' => 'required'
        ]);

        $files = $request->file('file');

        $allowfileExtensgion = ['jpg', 'png', 'jpeg'];

        foreach ($files as $key => $file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowfileExtensgion);

            if ($check) {
                $timestamp = Carbon::now()->toDateTimeString();
                $newFileName = session('user') . "_" . ($key + 1) . "_" . time() . '.' . $extension;
                $folderPath = 'public/chunks/';
                Storage::putFileAs($folderPath, $file, $newFileName);

                if (Storage::exists($folderPath . $newFileName)) {
                    $picture = new Chunk;
                    $picture->chunks_path = $newFileName;
                    $picture->user = session('user');
                    $picture->save();
                }
            }
        }

        $id = $request->query('id');
        return response()->json([
            'message' => 'upload success',
            'url' => route('manager.check.chunks', ['id' => $id])
        ]);

    }

    public function saveChunks(Request $request) {
        $id = $request->query('id');
        $chunks = Chunk::where('user','=',session('user'))->get();
        $name = [];

        foreach ($chunks as $key => $chunk) {
            $name["picture{$key}"] = $chunk->chunks_path;
            $folderPath = 'public/chunks/';
            $newFolderPath = 'public/hotelPicture/';
            $newFileName = $chunk->chunks_path;
            Storage::move($folderPath.$newFileName, $newFolderPath.$newFileName);
            $photo = new Photo;
            $photo->photos = $newFileName;
            $photo->hotel = $id;
            $photo->save();
            $chunk->delete();
        }

        return redirect()->route('manager.viewRoomDetails',['id'=>$id]);
    }

    public function deleteChunks(Chunk $chunk) {
        Storage::delete('public/chunks/'.$chunk->chunks_path);
        $chunk->delete();
        return redirect()->back();
    }

    public function storeDetails(Request $request){

        $request->validate([
            "name" => 'required',
            "province" => 'required',
            "amphures" => 'required',
            'address' => 'required',
            "about" => 'required',
            "facilities" => 'required'
        ]);

        $province = array_column(json_decode(file_get_contents('assets/js/thai_provinces.json'), true), 'name_th');

        $name = $request->input('name');
        $province_id = $request->input('province');
        $amphures = $request->input('amphures');
        $address = $request->input('address');
        $about = $request->input('about');

        if(is_null($request->input('near'))){
            $near = "";
        }else{
            $near = json_encode($request->input('near'));
        }

        $facilities = json_encode($request->input('facilities'));

        $update = new Hotel;

        $update->createId = session('user');
        $update->hotelName = $name;
        $update->province = $province[$province_id-1];
        $update->amphures = $amphures;
        $update->address = $address;
        $update->about = $about;
        $update->near = $near;
        $update->facilities = $facilities;
        $update->save();

        $insertedId = $update->id;


        if($update){
            return response()->json([
                "message" => [
                    "id" => $insertedId
                ]
            ],200);
        }
    }

    public function storeRoom(Request $request) {

        $validatedData = $request->validate([
            'room.*.quantity' => 'required',
            'room.*.type' => 'required',
            'room.*.price' => 'required',
            'room.*.numberOfBed' => 'required',
            'room.*.bedType' => 'required',
        ]);

        $id = $request->input('id');

        foreach ( $validatedData['room'] as $room){
            for($i = 1; $i<=$room['quantity']; $i++){
                Room::create([
                    'hotelId' => $id ,
                    'categories' => $room['type'],
                    'price' => $room['price'],
                    'numberOfBed' => $room['numberOfBed'],
                    'bedCategories' => $room['bedType']
                ]);
            }
        }

        return response()->json([
            'message' => 'success',
            'url' => route('manager.cms.home')
        ]);

    }

    public function updateDetails(Request $request) {

        $data = $request->input('data');

        $id = $request->id;

        $near = json_encode($request->input('near'));
        $facilities = json_encode($request->input('facilities'));

        $province = array_column(json_decode(file_get_contents('assets/js/thai_provinces.json'), true), 'name_th');

        $find = Hotel::find($id);
        $find->hotelName = $data['hotel'];
        $find->province = $province[$data['province']-1];
        $find->amphures = $data['amphures'];
        $find->address = $data['address'];
        $find->about = $data['about'];
        $find->near = $near;
        $find->facilities = $facilities;
        $find->save();

        return response()->json([
            "message" => 'update successful'
        ]);

    }

    public function updateRoom(Request $request) {

        $data = $request->input('data');
        $id = $request->input('id');
        $categories = $request->input('categories');
        
        $update = Room::where('hotelId',$id)
        ->where('categories',$categories)
        ->update([
            'categories'=>$data['categories'],
            'price'=>$data['price'],
            'numberOfBed' => $data['numberOfBed'],
            'bedCategories' => $data['bedCategories']
        ]);

        if($update){
            return response()->json([
                "message" => 'update successfully!!'
            ],200);
        }

    }

    public function deleteHotel(Request $request) {

        $id = $request->input('id');

        DB::beginTransaction();

        try {

            Hotel::where('id', $id)->delete();

            Room::where('hotelId', $id)->delete();

            DB::commit();

            return response()->json(['message' => 'Hotel and associated rooms deleted successfully'], 200);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json(['error' => 'Failed to delete hotel and associated rooms', 'details' => $e->getMessage()], 500);
        }
    }

    public function deleteRoom(Request $request) {

        $id = $request->input('id');
        $idHotel = $request->input('hotel');

        $find = Room::where('hotelId',$idHotel)->count();

        if($find == 1 ){
            return response()->json([
                'message' => 'You should have room in hotel at least 1 room'
            ],500);
        }

        DB::beginTransaction();

        try{

            Room::where('id','=',$id)->delete();

            DB::commit();

            return response()->json(['message' => 'rooms deleted successfully'], 200);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json(['error' => 'Failed to delete rooms', 'details' => $e->getMessage()], 500);

        }

    }



}
