<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;

class ConversationController extends Controller
{
    public function list(Request $request)
    {
        $request->validate([
            'sender' => ['required', 'numeric'],
            'receiver' => ['required', 'numeric']
        ]);

        return Conversation::all()->where('sender', '=', $request->sender)
                                  ->where('receiver', '=', $request->receiver);
    }

    public function add(Request $request)
    {
        $request->validate([
            'sender' => ['required', 'numeric'],
            'receiver' => ['required', 'numeric'],
            'message' => ['required', 'content']
        ]);

        return Conversation::create([
            'sender' => $request->sender,
            'receiver' => $request->receiver,
            'content' => $request->message
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric']
        ]);

        $conversation = Conversation::find($request->id);
        $conversation->deleted = 1;
        return $conversation->save();
    }
}