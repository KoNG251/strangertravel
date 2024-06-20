<?php

namespace App\Http\Controllers\chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\MemberGroup;
use App\Models\Message;
use Illuminate\Support\Facades\Storage;
use Pusher\Pusher;
use Illuminate\Support\Facades\DB;

class chatController extends Controller
{
    public function index() {
       return view('chat.chat');
    }

    public function createGroup(Request $request) {

        $request->validate([
            'create_id' => 'required',
            'picture_file' => 'required|image',
            'group_name' => 'required'
        ]);

        $file = $request->file('picture_file');
        $newFileName = $request->input('group_name') . '_' . time() . '.' . $file->getClientOriginalExtension();
        $folderPath = '/public/groupProfiles/';
        Storage::disk('local')->put($folderPath . $newFileName, file_get_contents($file));

        if (Storage::disk('local')->exists($folderPath.$newFileName)) {
            $create = Group::create([
                'create_id' => $request->input('create_id'),
                'picture_file' => $newFileName,
                'group_name' => $request->input('group_name')
            ]);

            $group = MemberGroup::create([
                'user_id' => session('user'),
                'group_id' => $create->id
            ]);

            if($create && $group){
                return response()->json([
                    'message' => 'Create group successful'
                ]);
            }

        }

    }

    public function getChat() {

        $group = MemberGroup::where('user_id','=',session('user'))
        ->join('groups','groups.id','=','member_groups.group_id')
        ->get();

        return response()->json([
            'message' => $group
        ]);

    }

    public function getMessage($id) {

        $join = MemberGroup::where('user_id','=',session('user'))
        ->where('group_id','=',$id)
        ->value('created_at');

        $message = Message::where('group_id','=',$id)
        ->join('users','users.id','=','messages.sender_id')
        ->select('messages.*', 'users.fname', 'users.lname','users.userPicturePath')
        ->where('messages.created_at',">=",$join)
        ->get();

        return response()->json([
            'message' => $message
        ]);

    }

    public function getGroup() {

        $userId = session('user');

        $group = Group::whereDoesntHave('users', function ($query) use ($userId) {
            $query->where('users.id', $userId);
        })->get();

        return response()->json([
            'message' => $group
        ]);

    }

    public function sendMessage(Request $request) {
        $request->validate([
            'sender_id' => 'required',
            'message' => 'required',
            'group_id' => 'required'
        ]);

        $message = Message::create([
            'sender_id' => $request->input('sender_id'),
            'body' => $request->input('message'),
            'group_id' => $request->input('group_id'),
            'type' => 'text'
        ]);

        $joinedData = DB::table('messages')
        ->join('users','users.id','=','messages.sender_id')
        ->where('messages.id', $message->id)
        ->select('messages.*', 'users.fname', 'users.lname','users.userPicturePath')
        ->first();

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true,
            ]
        );

        $pusher->trigger('group-chat-channel-' . $request->input('group_id'), 'new-message', $joinedData);

        return response()->json([
            'message' => 'send message success'
        ]);
    }

    function joinGroup(Request $request) {
        $request->validate([
            'id' => 'required'
        ]);

        $join = MemberGroup::create([
            'user_id' => session('user'),
            'group_id' => $request->input('id')
        ]);

        if($join){

        return response()->json([
            'message' => "Join Community Successful"
        ],200);

        }

    }

    function leaveGroup(Request $request) {

        $request->validate([
            'id' => 'required'
        ]);

        $leave = MemberGroup::where('user_id',session('user'))
        ->where('group_id',$request->input('id'))
        ->delete();

        return response()->json([
            'message' => "Leave Group Successful"
        ],200);

    }


}
