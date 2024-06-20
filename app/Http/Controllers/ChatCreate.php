<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\CreateGroup;
use App\Models\MemberGroup;
use App\Models\Conversation;
use App\Models\Message;

class ChatCreate extends Controller
{

    public $message = 'Hello';

    public function create(){
        return view('create_group');
    }

    public function storeGroup(Request $request) {

        $request->validate([
            'file' => 'required|image|max:10240',
            'name' => 'required',
            'detail' => 'required',
        ]);

        $file = $request->file('file');
        $newFileName = $request->name . '_' . time() . '.' . $file->getClientOriginalExtension();

        $folderPath = '/public/groupProfiles/';
        Storage::disk('local')->put($folderPath . $newFileName, file_get_contents($file));

        if (Storage::disk('local')->exists($folderPath.$newFileName)) {
            $create = CreateGroup::create(['createID'=>session('user'),'groupName'=>$request->name,'groupDetail'=>$request->detail,'picture'=>$newFileName]);

            if($create){
                $createdConversation = Conversation::create(['receiver_id'=>$create->id]);
                $member = MemberGroup::create(['userID'=>session('user'),'groupID'=>$create->id]);
                $createdMessage = Message::create(['conversation_id'=>$createdConversation->id,'sender_id'=>session('user'),'receiver_id'=>$create->id,'body'=>$this->message]);
                $createdConversation->last_time_message = $createdMessage->created_at;
                $createdConversation->save();

                if($createdConversation && $member && $createdMessage){
                    Alert::success('Success','ทำการสร้างกลุ่มเสร็จสิ้น');
                    return redirect()->route('chatGroup');
                }
            }

        }else{
            Alert::error('Error','อัปโหลดไฟล์ไม่สำเร็จ');
            return redirect()->route('createChat');
        }

    }
}
