<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Conversation;
use App\Models\CreateGroup;
use App\Models\Message;
use App\Models\userProfile;
use App\Models\MemberGroup;
use App\Events\MessageSent;

class Chatbox extends Component
{

    public $selectedConversation;
    public $receiverInstance;
    public $messageInstance;
    public $paginateVar = 10;
    public $messages;
    public $peopleInstance;
    public $newMessage;
    

    // protected $listeners = ['loadConversation'=>'handelConversation','pushMessage','loadmore'];

    
    public function handelConversation(Conversation $conversation,CreateGroup $receiver) {
        
        $this->selectedConversation = $conversation;
        $this->receiverInstance = $receiver;
        
        $this->messages_count = Message::where('conversation_id',$this->selectedConversation->id)->count();
        
        $this->messages = Message::select('messages.id','messages.sender_id','user_profiles.fname','user_profiles.lname','user_profiles.userPicturePath','messages.body','messages.created_at')
        ->where('conversation_id', $this->selectedConversation->id)
        ->join('user_profiles','user_profiles.id','=','messages.sender_id')
        ->orderBy('messages.created_at','ASC')
        ->skip($this->messages_count - $this->paginateVar)
        ->take($this->paginateVar)->get();

        $this->dispatch('chatSelected');
        $this->dispatch('MessageSent', ['group_id' => $this->receiverInstance->id]);


    }
    
    public function pushMessage($messageId) {
        $this->newMessage = Message::find($messageId);
        $this->messages->push($this->newMessage);

        // dd($this->newMessage->receiver_id);

        $this->dispatch('rowChatToBottom');

    }

    public function getListeners() {
        $auth_id = session('user');
        return [
            "echo-private:chat.{$auth_id},MessageSent"=>'broadcastedMessageReceived',
            'loadConversation'=>'handelConversation',
            'pushMessage',
            'loadmore',
        ];
    }

    function broadcastedMessageReceived($event){
        \Log::info('event:', $event);
    }

    function loadmore() 
    {
        dd('top reached');
    }

    public function render()
    {
        return view('livewire.chat.chatbox');
    }
}
