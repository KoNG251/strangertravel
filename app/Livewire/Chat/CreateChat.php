<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\MemberGroup;
use App\Models\UserProfile;
use App\Models\CreateGroup;
use App\Models\Conversation;
use App\Models\Message;

class CreateChat extends Component
{
    public $groups;
    public $auth_id;
    public $message = 'hello how are you';

    public function checkConversation($receiverId)
    {
        // dd($receiverId);
        $this->auth_id = session('user');
        $checkedGroup = MemberGroup::where('groupID',$receiverId)->where('userID',$this->auth_id)->get();

        if(count($checkedGroup) == 0){
            
            $createdConversation = MemberGroup::create(['groupID'=>$receiverId,'userID'=>$this->auth_id]);
            $createdMessage = Message::create(['conversation_id'=>$createdConversation->id,'sender_id'=>$this->auth_id,'receiver_id'=>$receiverId,'body'=>$this->message]);

            $createdConversation->save();
            $coversation = Conversation::where('receiver_id',$receiverId)->update(['last_time_message'=>$createdMessage->created_at]);

        }elseif(count($checkedGroup) >= 1){
            dd('group already');
        }
    }

    public function render()
    {
        $this->groups = CreateGroup::get();
        return view('livewire.chat.create-chat');
    }
}
