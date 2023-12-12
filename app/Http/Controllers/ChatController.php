<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereNot('id', Auth::id())->paginate(10);
        return view("chat.index", [
            "users"=> $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try{

            $chat = Chat::whereJsonContains('users', $id)
            ->whereJsonContains('users', Auth::id())
            ->first();
            if (!$chat) {
                $chat = new Chat();
                $chat->users = array($id, Auth::id());
                $chat->save();
            }

            update_read($chat->id);

            $messages = Message::where('chat_id', $chat->id)
            ->get();

            return view('chat.chat', [
                'chat'=> $chat,
                'messages' => $messages
            ]);
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
