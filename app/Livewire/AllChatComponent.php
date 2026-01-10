<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class AllChatComponent extends Component
{
    public function render()
    {
        $messages = Message::where('sender_id', Auth::id())->orWhere('receiver_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $messages = $messages->filter(function ($message) {
            return $message->is_read == false;
        });


        // O'zimizni "Onlayn" qilib yangilaymiz
        User::find(Auth::id())->update(['last_seen_at' => now()]);

        // Biz bilan yozishgan barcha foydalanuvchilar
        $users = User::where('id', '!=', Auth::id())
            ->where(function ($query) {
                $query->has('sentMessages')
                    ->orHas('receivedMessages');
            })->get();

        // Har bir foydalanuvchi uchun o'qilmagan xabarlar sonini hisoblash
        foreach ($users as $user) {
            $user->unread_count = Message::where('sender_id', $user->id)
                ->where('receiver_id', Auth::id())
                ->where('is_read', false)
                ->count();

            // Onlayn holati (10 soniya ichida faol bo'lgan bo'lsa)
            $user->is_online = $user->last_seen_at &&
                $user->last_seen_at->diffInSeconds(now()) < 10;
        }
        return view('livewire.all-chat-component', [
            'users' => $users,
            'messages' => $messages
        ]);
    }
}
