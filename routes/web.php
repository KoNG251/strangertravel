<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\indexController;
use App\Http\Controllers\userController;
use App\Http\Controllers\EmailOtpController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\calculateController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Manager\addHotel;
use App\Http\Controllers\booking\viewController;
use App\Http\Controllers\booking\bookingController;
use App\Http\Controllers\chat\chatController;
use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\Manager\dashboardManageController;
use App\Models\Admin;
use App\Models\User;
use App\Models\Chunk;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [indexController::class,'index'])->name('index')->middleware('checkIndex');
Route::get('/calculate',[calculateController::class,'index'])->name('calculate');
Route::get('/view/login',[userController::class,'viewLogin'])->name('viewlogin');
Route::get('/view/register',[userController::class,'viewRegister'])->name('viewregister');
Route::post('/auth/login/checkdata',[userController::class,'login'])->name('login_self');
Route::post('/auth/logout/self',[userController::class,'userLogout'])->name('logout_self');
Route::post('/auth/register/store',[userController::class,'register'])->name('register_self');
Route::post('/calculate/api/results',[calculateController::class,'calculate']);
Route::get('/calculate/results',[calculateController::class,'viewResults']);

// facebook
// Route::get('auth/facebook', [FacebookController::class,'redirectToFacebook'])->name('auth.facebook');
// Route::get('auth/facebook/callback', [FacebookController::class,'handleFacebookCallback']);

//


Route::get('/api/get/info',function() {
    $user = User::find(session('user'));

    return response()->json([
        'message' => $user
    ]);
});

Route::get('/chat/{id?}',[chatController::class,'index'])->name('chat');

// chat

Route::prefix('chat')->name('chat.')->group(function () {
    Route::post('/create/group',[chatController::class,'createGroup'])->name('create');
    Route::get('/api/get/chatlist',[chatController::class,'getChat'])->name('api.chatlist');
    Route::get('/api/get/message/{id}',[chatController::class,'getMessage'])->name('api.message');
    Route::post('/api/send/message',[chatController::class,'sendMessage'])->name('api.send.message');
    Route::get('/api/get/group',[chatController::class,'getGroup'])->name('api.group');
    Route::post('/api/join/group',[chatController::class,'joinGroup'])->name('api.join.group');
    Route::post('/api/leave/group',[chatController::class,'leaveGroup'])->name('api.leave.group');
    Route::get('/api/badword',[chatController::class,'escapeBadWord']);
});

// booking
Route::prefix('booking')->name('booking.')->group(function (){

    Route::get('/hotel/information',[viewController::class,'viewInformation'])->name('information');
    Route::get('/information',[viewController::class,'bookingInformation'])->name('info');
    Route::post('/add',[bookingController::class,'addToBooking'])->name('add');
    Route::get('/payment',[viewController::class,'viewPayment'])->name('payment');
    Route::post('/payment/creditcard/process',[bookingController::class,'processCreditPayment'])->name('payment.card');
    Route::post('/payment/promptpay/process',[bookingController::class,'processPromptPay'])->name('payment.promptpay');
    Route::get('/success',[viewController::class,'viewSuccess'])->name('success');

});

Route::prefix('auth')->name('auth.')->middleware(['auth.user'])->group(function (){
    Route::get('/profiles',[userController::class,'updateRoute'])->name('profiles');
    Route::post('/update/profile',[userController::class,'updatePicture'])->name('update.picture');
    Route::post('/update/details',[userController::class,'updateDetail'])->name('update.detail');
    Route::post('/update/password',[userController::class,'updatepassword'])->name('update.password');
    Route::patch('/delete/account',[userController::class,'deleteAccout'])->name('delete.account');
    Route::get('/',[userController::class,'viewAuth'])->name('authentication');
    Route::get('/auth/send-otp/', [OtpController::class, 'sendOtp'])->name('sendOtp');
    Route::get('/auth/verify/phone',[OtpController::class,'phoneVerify'])->name('phoneVerify');
    Route::post('/auth/verify/phone/check',[OtpController::class,'checkOtp'])->name('checkOtp');
    Route::post('/auth/verify/email/check',[OtpController::class,'checkEmailOtp'])->name('checkEmailOtp');
    Route::get('/auth/verify/email', [EmailOtpController::class,'sendOtp'])->name('emailVerify');
});

Route::prefix('manager')->name('manager.')->group(function(){

    Route::get('/',function() {
        return view('manager.index');
    })->name('index')->middleware(['checkLoginManager']);

    Route::get('/signup',function() {
        return view('manager.register');
    })->name('signup');

    Route::get('/view/add/picture',function(Request $request) {
        $id = $request->query('id');
        return view('manager.picture')->with(['id' => $id]);
    })->middleware(['auth.manager'])->name('picture');

    Route::prefix('/api')->name('api.')->group(function() {
        Route::post('/login',[ManagerController::class,'login']);
        Route::post('/logout',[ManagerController::class,'logout']);
        Route::post('/store/data',[ManagerController::class,'register']);

        Route::get('/get/info',function() {
            $user = User::find(session('manager'));

            return response()->json([
                'message' => $user
            ]);
        })->middleware(['auth.manager']);

        Route::middleware(['auth.manager'])->group(function () {

            Route::get('/get/hotel',function() {

                $hotel = Hotel::select(
                    'hotels.id',
                    'hotels.hotelName as name',
                    'hotels.province',
                    DB::raw('GROUP_CONCAT(photos.photos) as photos')
                )
                ->join('photos', 'hotels.id', '=', 'photos.hotel')
                ->where('hotels.createId', '=', session('manager'))
                ->groupBy('hotels.id', 'hotels.hotelName', 'hotels.province')
                ->paginate(20);

                return response()->json([
                    'message' => $hotel
                ]);

            });

            Route::post('/update/profile',[ManagerController::class,'updateDetail']);
            Route::post('/update/password',[ManagerController::class,'updatePassword']);
            Route::post('/store/details',[addHotel::class,'storeDetails']);
            Route::post('/store/chunks',[addHotel::class,'chunksfile'])->name('chunks');
            Route::post('/hotel/store/update/room',[addHotel::class,'updateRoom'])->name('store.update.room');
            Route::post('/hotel/delete/',[addHotel::class,'deleteHotel'])->name('delete.hotel');
            Route::post('/room/delete/',[addHotel::class,'deleteRoom'])->name('delete.room');
            Route::post('/hotel/store/update',[addHotel::class,'updateDetails'])->name('store.update');
            Route::get('/get/info/hotel',[ManagerController::class,'getInfoHotel']);
            Route::get('/get/info/room',[ManagerController::class,'getInfoRoom']);
            Route::get('/get/dashboard/information',[dashboardManageController::class,'dashboardInformation']);

        });
    });

    Route::prefix('/cms')->name('cms.')->middleware(['auth.manager'])->group(function() {

        Route::get('/home',function() {
            return view('manager.home');
        })->name('home');

        Route::get('/authentication',function() {
            return view('manager.authentication');
        })->name('authentication');

        Route::get('/new/hotel',function() {
            return view('manager.hotel');
        })->name('add');

        Route::get('/edit/hotel',function() {
            return view('manager.edit');
        })->name('edit');

    });

    Route::middleware(['auth.manager'])->group(function () {

        Route::get('/check/chunks',function (Request $request) {
            $id = $request->query('id');
            $chunks = Chunk::where('user','=',session('user'))->get();
            return view('manager.managePicture')->with(['chunks'=>$chunks,'id'=>$id]);
        })->name('check.chunks')->middleware(['checkHaveChunks']);

        Route::delete('/chunks/delete/{chunk}',[addHotel::class,'deleteChunks'])->name('chunks.delete');
        Route::post('/chunks/save',[addHotel::class,'saveChunks'])->name('chunks.save');

        Route::get('/view/rooms',function() {
            return view('manager.roomDetails');
        })->name('viewRoomDetails');
        Route::post('/store/rooms',[addHotel::class,'storeRoom'])->name('storeRoomDetails');

        Route::get('/hotel/update',function (Request $request)  {
            return view('manager.update');
        })->name('update');

        Route::get('/hotel/view/update/room',function (Request $request) {

            return view('manager.updateroom');

        })->name('view.update.room');

    });

});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/',function() {
        return view('admin.index');
    })->middleware(['checkLoginAdmin'])->name('index');

    Route::prefix('api')->name('api.')->group(function() {
        Route::post('/login',[adminController::class,'login'])->name('admin.login');

        Route::get('/get/info',function() {
            $user = Admin::find(session('admin'));

            return response()->json([
                'message' => $user
            ]);
        })->middleware(['auth.admin']);

        Route::middleware(['auth.admin'])->group(function() {

            Route::post('/store/admin',[adminController::class,'storeAdmin']);
            Route::get('/get/admin',[adminController::class,'allAdmin']);
            Route::post('/check/hotel',[adminController::class,'checkHotel']);
            Route::post('/logout',[adminController::class,'logout']);
            Route::get('/get/count/user',[dashboardController::class,'user']);
            Route::get('/get/count/group',[dashboardController::class,'group']);
            Route::get('/get/count/booking',[dashboardController::class,'booking']);
            Route::get('/get/count/hotel',[dashboardController::class,'hotel']);
            Route::get('/get/count/amount',[dashboardController::class,'amount']);
            Route::get('/get/count/all/user',[dashboardController::class,'alluser']);
            Route::get('/get/hotel',[dashboardController::class,'notVerifyHotel']);
            Route::get('/get/infomation/hotel',[dashboardController::class,'getInfoHotel']);

        });

    });

    Route::prefix('cms')->name('cms.')->middleware(['auth.admin'])->group(function() {

        Route::get('/',function(){
            return view('admin.home');
        })->name('home');

        Route::get('/account',function() {
            return view('admin.account');
        })->name('account');

        Route::get('/hotel',function() {
            return view('admin.hotel');
        })->name('hotel');

        Route::get('/hotel/check',function() {
            return view('admin.check');
        })->name('hotel.check');

    });

});


require __DIR__.'/auth.php';
