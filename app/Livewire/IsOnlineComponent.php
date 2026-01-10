<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class IsOnlineComponent extends Component
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

        return view('livewire.is-online-component', [
            'user' => $user,
            'isOnline' => $isOnline,
        ]);
    }
}
