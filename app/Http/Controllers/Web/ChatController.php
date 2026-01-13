<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        if (Auth::id() == $id) {
            return redirect()->route('allchat');
        }
        $work = Work::find(request()->get('work_id')) ?? null;
        $user = User::findOrFail($id);
        $messages = Message::where(function ($query) use ($id) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('sender_id', $id)
                ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        return view('user.chat', compact('user', 'messages', 'work'));
    }

    public function send(Request $request, $id)
    {

        $request->validate([
            'message' => 'required_without:file|string|max:1000',
            'redirect' => 'nullable|string',
            'file' => 'nullable|file|max:5120', // Max 5MB
        ]);

        $message = new Message();
        $message->sender_id = Auth::id();
        $message->receiver_id = $id;
        $message->message = $request->input('message');
        $message->redirect = $request->input('redirect');

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

    public function update(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::findOrFail($id);

        // Ensure that only the sender can update the message
        if ($message->sender_id !== Auth::id()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }

        $message->update([
            'message' => $request->input('message'),
            'edited_date' => Carbon::now(),
        ]);

        return response()->json(['status' => 'success']);
    }

    public function destroy($id)
    {
        $chat = Message::where(function ($query) use ($id) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('sender_id', $id)
                ->where('receiver_id', Auth::id());
        })->get();
        foreach ($chat as $message) {
            $message->delete();
        }
        return redirect()->route('allchat');
    }

    public function messageDestroy($id)
    {
        $message = Message::findOrFail($id);

        // Ensure that only the sender can delete the message
        if ($message->sender_id !== Auth::id()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }

        $message->delete();

        return response()->json(['status' => 'success']);
    }
}
