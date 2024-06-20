<?php

namespace App\Events;

use App\Models\UserProfile;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\CreateGroup;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Support\Facades\Log;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;
    public $conversation;
    public $receiver;

    public function __construct($user, Message $message, Conversation $conversation, CreateGroup $receiver)
    {
        $this->user = $user;
        $this->message = $message;
        $this->conversation = $conversation;
        $this->receiver = $receiver;

        Log::info('Broadcast Constructed:', ['user' => $user, 'message_id' => $message->id, 'conversation_id' => $conversation->id, 'receiver_id' => $receiver->id]);
    }

    public function broadcastWith() {
        return [
            'user_id' => $this->user,
            'message_id' => $this->message->id,
            'conversation_id' => $this->conversation->id,
            'receiver_id' => $this->receiver->id,
        ];
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.'.$this->receiver->id);
    }
}
