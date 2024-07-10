<?php

namespace App\Http\Controllers\booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Hotel;
use App\Models\booking;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use OmiseCharge;
use Illuminate\Support\Facades\Mail;
use App\Mail\Booking as BookingMail;

define('OMISE_PUBLIC_KEY', env('OMISE_PUBLIC_KEY',false));
define('OMISE_SECRET_KEY', env('OMISE_SECRET_KEY',false));
define('OMISE_API_VERSION', env('OMISE_API_VERSION',false));

class bookingController extends Controller
{

    public function addToBooking(Request $request){

        $request->validate([
            'data'=>'required',
            'start'=>'required',
            'end'=>'required',
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'tel' => 'required'
        ]);

        $data = $request->input('data');
        $data = explode(',',$data);
        $start = $request->input('start');
        $end = $request->input('end');
        $fname = $request->input('fname');
        $lname = $request->input('lname');
        $email = $request->input('email');
        $tel = $request->input('tel');
        $price = $request->input('price');

        DB::beginTransaction();

        $bookingID = [];

        foreach($data as $item){
            $check = Booking::where('roomId',$item)
            ->where('check_in','<',$end)
            ->where('check_out','>',$start)
            ->count();

            if($check > 0){
                DB::rollBack();
                return response()->json([
                    "message" => 'Some room has booking'
                ],500);
            }

            if(session('user') == null || empty(session('user'))){
                $user = null;
            }else{
                $user = session('user');
            }

            $booking = new Booking;
            $booking->userId = $user;
            $booking->fname = $fname;
            $booking->lname = $lname;
            $booking->email = $email;
            $booking->tel = $tel;
            $booking->roomId = $item;
            $booking->check_in = date("Y-m-d", strtotime($start));
            $booking->check_out = date("Y-m-d", strtotime($end));
            $booking->save();

            $bookingID[] = $booking->id;

        }

        DB::commit();

        return response()->json([
            "message" => [
                'message'=>'You have five minutes to pay.',
                'bookingId' => $bookingID,
                'price' => $price
            ],
        ],200);

    }


    public function processCreditPayment(Request $request) {

        $request->validate([
            'omiseToken' => 'required'
        ]);

        $omiseToken = $request->input('omiseToken');
        $price = $request->input('price');
        $bookingID = $request->input('bookingId');
        $booking = explode(',',$bookingID);

        if(session('user') == null || empty(session('user'))){
            $user = null;
        }else{
            $user = session('user');
        }

        DB::beginTransaction();

        try {

            $charge = \OmiseCharge::create([
                'amount' => $price*100,
                'currency' => 'thb',
                'card' => $omiseToken
            ]);


            if ($charge['status'] === 'successful') {

                foreach($booking as $data){
                    $find = Booking::find($data);
                    $find->status = 1;
                    $find->save();
                }

                $transaction = new Transaction;
                $transaction->user = $user;
                $transaction->price = $price;
                $transaction->bookingID = $bookingID;
                $transaction->save();

                $email = booking::where('id', '=', $bookingID)->first();

                Mail::to($email->email)->send(new BookingMail($bookingID));

                DB::commit();

                return response()->json(['message' => 'Payment successful',], 200);

            } else {
                DB::rollBack();
                return response()->json(['error' => 'Payment failed'], 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function processPromptPay(Request $request) {

        $price = $request->input('price');

        $charge = \OmiseCharge::create([
            'amount' => $price*100,
            'currency' => 'THB',
            'source' => [
                'type' => 'promptpay',
            ],
        ]);


        $qrCodeUrl = $charge['source']['scannable_code']['image']['download_uri'];

        // Return the QR code URL in the response
        return response()->json(['qrCodeUrl' => $qrCodeUrl]);
    }

}
