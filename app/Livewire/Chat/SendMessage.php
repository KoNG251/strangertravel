<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Conversation;
use App\Models\CreateGroup;
use App\Models\Message;
use App\Models\userProfile;
use App\Livewire\Chat\Chatbox;
use App\Events\MessageSent;

class SendMessage extends Component
{

    public $selectedConversation;
    public $receiverInstance;
    public $body;
    public $createdMessage;
    protected $listeners = ['updateSendMessage','dispatchMessageSent'];

    function updateSendMessage(Conversation $conversation,CreateGroup $receiver){
        
        $this->selectedConversation = $conversation;
        $this->receiverInstance = $receiver;

    }

    public function sendMessage(){

        if($this->body == null){
            return null;
        }

        $this->createdMessage = Message::create([
            'conversation_id'=>$this->selectedConversation->id,
            'sender_id'=>session('user'),
            'receiver_id'=>$this->receiverInstance->id,
            'body'=>$this->body,

        ]);

        $this->selectedConversation->last_time_message = $this->createdMessage->created_at;
        $this->selectedConversation->save();

        $this->dispatch('pushMessage',$this->createdMessage->id)->to('chat.chatbox');;
        $this->dispatch('refresh')->to('chat.chat-list');
        $this->reset('body');

        $this->dispatch('dispatchMessageSent');

    }

    public function dispatchMessageSent()
    {
        
        $auth_id = session('user');
        $messageSentEvent = new MessageSent($auth_id, $this->createdMessage, $this->selectedConversation, $this->receiverInstance);

       // Log the broadcast data
        \Log::info('Broadcast data:', $messageSentEvent->broadcastWith());

        // Log the channels
        \Log::info('Broadcast channels:', ['channel' => $messageSentEvent->broadcastOn()->name]);

        // Use Laravel's broadcast function
        broadcast($messageSentEvent);

    }


    public function render()
    {
        return view('livewire.chat.send-message');
    }
}
