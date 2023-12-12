<?php

namespace App\Livewire;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatComponent extends Component
{
    public $chat_id, $message;

    public function mount($chat_id)
    {
        $this->chat_id = $chat_id;
    }
    public function render()
    {
        $messages = Message::where('chat_id', $this->chat_id)
        ->get();
        return view('livewire.chat-component', [
            'messages'=> $messages
        ]);
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => ['required','string'],
        ]);

        $new_message = new Message();
        $new_message->chat_id = $this->chat_id;
        $new_message->user_id = Auth::id();
        $new_message->content = $this->message;
        $new_message->save();

        $this->message = "";
    }
}
