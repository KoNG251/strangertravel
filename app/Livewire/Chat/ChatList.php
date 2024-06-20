<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Conversation;
use App\Models\MemberGroup;
use App\Models\Message;
use App\Models\CreateGroup;


class ChatList extends Component
{

    public $auth_id;
    public $conversations;
    public $message;
    public $name;
    public $receiverInstance;
    public $selectedConversation;
    public $selectedGroup;

    
    protected $listeners = ['chatGroupSelected','refresh'=>'$refresh'];

    public function chatGroupSelected(MemberGroup $conversation,$receiverId) {

        // dd($conversation,$receiverId);

        $this->selectedConversation = $conversation;
        $receiverInstance = CreateGroup::find($receiverId);

        $this->selectedGroup = Conversation::where('receiver_id',$conversation->groupID)->first();
        
        $this->dispatch('loadConversation',$this->selectedGroup, $receiverInstance)->to('chat.chatbox');
        $this->dispatch('updateSendMessage',$this->selectedGroup,$receiverInstance)->to('chat.send-message');

    }

    // call Data group
    public function getChatGroupInstance(MemberGroup $conversation,$request){
        $this->auth_id = session('user');
        $this->receiverInstance = CreateGroup::firstWhere('id',$conversation->groupID);

        if(isset($request)){
            return $this->receiverInstance->$request;
        }
    }

    // call Data message
    public function getDataInstance(MemberGroup $conversation,$request){
        $this->receiverInstance = Message::where('messages.receiver_id', $conversation->groupID)
        ->orderBy('messages.created_at', 'DESC')
        ->first();

        
        if(isset($request)){
            return $this->receiverInstance->$request;
        }
    }

    // call all group
    public function mount(){
        $this->auth_id = session('user');
        $this->conversations = MemberGroup::where('userID',$this->auth_id)
        ->get();
    }



    public function render()
    {
        return view('livewire.chat.chat-list');
    }
}
