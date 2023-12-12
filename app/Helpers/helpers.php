<?php

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

function get_username($id)
{
    $user = User::find($id);
    if(is_null($user)) {
        return "Unknown";
    }

    return $user->name;
}

function get_unread_chats()
{
    $chats = Chat::join('messages', 'messages.chat_id', '=', 'chats.id')
        ->whereJsonContains('chats.users', Auth::id())
        ->where('messages.read', false)
        ->whereNot('messages.user_id', Auth::id())
        ->count();

    if($chats > 0) {
        echo "<span class='badge bg-secondary mx-3'>".$chats."</span>";
        return;
    }

    return "";
}

function get_unread_messages($user_id)
{
    $chat = Chat::whereJsonContains('users', $user_id)
        ->whereJsonContains('users', Auth::id())
        ->first();
    if (!$chat) {
        return "";
    }

    $messages = Message::where('chat_id', $chat->id)
        ->whereNot('user_id', Auth::id())
        ->where('read', false)
        ->count();

    if($messages > 0) {
        echo "<span class='badge bg-secondary'>".$messages."</span>";
        return;
    }

    return "";
}

function update_read($chat_id){
    Message::where('chat_id', $chat_id)->where('read', false)->whereNot('user_id', Auth::id())->update(['read' => true]);
}
