<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Hotel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class adminController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Admin::where('email',$request->input('email'))->first();

        if($admin === null){
            return response()->json([
                'message' => 'User not found'
            ],500);
        }

        if(Hash::check($request->input('password'),$admin->password)){

            session(['admin' => $admin->id, 'fname' => $admin->fname, 'lname' => $admin->lname, 'email' => $admin->email]);

            return response()->json([
                "message" => "login successful",
                'url' => route('admin.cms.home')
            ]);

        }
    }

    public function storeAdmin(Request $request) {

        $request->validate([
            'email' => 'required|email|unique:admins,email',
            'password' => 'required'
        ]);

        $create = Admin::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        return response()->json([
            'message' => 'Add new admin success'
        ]);

    }

    public function allAdmin() {
        $admin = Admin::where('id','!=',session('admin'))->paginate(20);

        return response()->json([
            'message' => $admin
        ]);

    }

    public function checkHotel(Request $request) {

        $request->validate([
            'id' => 'required',
            'value' => 'required|min:1|max:1'
        ]);

        $hotel = Hotel::find($request->input('id'));
        $hotel->admin_check = $request->input('value');
        $hotel->save();

        $message = $request->input('value') == 1 ? 'Accept success' : 'Reject success' ;

        return response()->json([
            'message' => $message,
            'url' => route('admin.cms.hotel')
        ]);

    }

    public function logout() {
        Session::flush();

        return response()->json([
            'url' => route('admin.index')
        ]);

    }

}
