<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatMessages extends Component
{
    public $userId; // Suhbatdosh IDsi

    public function mount($id)
    {
        $this->userId = $id;
    }

    public function render()
    {
        $user = User::findOrFail($this->userId);

        // O'z vaqtingizni yangilang
        User::find(Auth::id())->update(['last_seen_at' => now()]);

        $user = User::findOrFail($this->userId);

        // Foydalanuvchi onlaynligini tekshirish (masalan, oxirgi 1 daqiqa ichida faol bo'lgan bo'lsa)
        $isOnline = $user->last_seen_at && $user->last_seen_at->diffInSeconds(now()) < 10;

        $messages = Message::where(function ($query) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $this->userId);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->userId)
                ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        // O'qilmagan xabarlarni o'qildi qilish
        foreach ($messages as $message) {
            if ($message->receiver_id == Auth::id() && !$message->is_read) {
                $message->is_read = true;
                $message->save();
            }
        }

        return view('livewire.chat-messages', [
            'user' => $user,
            'messages' => $messages,
            'isOnline' => $isOnline,
        ]);
    }
}
