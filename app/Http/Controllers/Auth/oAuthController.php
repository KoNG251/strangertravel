<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class oAuthController extends Controller
{
    public function redirectFacebook() {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook() {
        $user = Socialite::driver('facebook')->stateless()->user();

        $this->getUser($user);

        return redirect()->route('index');

    }

    private function getUser($user) {
        $userExist = User::where('email', $user->email)->first();
    
        if (!$userExist) {
            $name = explode(' ', $user->name);
            $newRowUser = User::create([
                'email' => $user->email,
                'password' => Hash::make($user->id), 
                'fname' => $name[0],
                'lname' => $name[1] ?? "",
                'user' => 'member',
                'status' => 1
            ]);
    
            session([
                'user' => $newRowUser->id,
                'fname' => $newRowUser->fname,
                'lname' => $newRowUser->lname,
                'email' => $newRowUser->email
            ]);
        } else {
            session([
                'user' => $userExist->id,
                'fname' => $userExist->fname,
                'lname' => $userExist->lname,
                'email' => $userExist->email
            ]);
        }
    }
    

}
