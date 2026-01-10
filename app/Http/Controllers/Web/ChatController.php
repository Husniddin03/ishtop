<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function allchat()
    {
        $users = User::has('sentMessages')->orHas('receivedMessages')->get();
        $users = $users->filter(function ($user) {
            return $user->id !== Auth::id();
        });
        $messages = Message::where('sender_id', Auth::id())->orWhere('receiver_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $messages = $messages->filter(function ($message) {
            return $message->is_read == false;
        });
        return view('user.allchat', compact('users', 'messages'));
    }

    public function chat($id)
    {
        $user = User::findOrFail($id);
        $messages = Message::where(function ($query) use ($id) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('sender_id', $id)
                ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        // all do ready


        return view('user.chat', compact('user', 'messages'));
    }

    public function send(Request $request, $id)
    {

        $request->validate([
            'message' => 'required_without:file|string|max:1000',
            'file' => 'nullable|file|max:5120', // Max 5MB
        ]);

        $message = new Message();
        $message->sender_id = Auth::id();
        $message->receiver_id = $id;
        $message->message = $request->input('message');

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('chat_files', 'public');
            $message->file = $filePath;
            $message->file_type = $request->file('file')->getClientMimeType();
        }

        $message->save();

        return redirect()->route('chat', ['id' => $id]);
    }

    public function markAsRead($id)
    {
        $messages = Message::where('sender_id', $id)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->get();

        foreach ($messages as $message) {
            $message->is_read = true;
            $message->save();
        }

        return response()->json(['status' => 'success']);
    }
}
