<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CountMessagesComponent extends Component
{

    public function render()
    {
        $count = Message::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->pluck('sender_id')
            ->unique()
            ->count();

        
        return view('livewire.count-messages-component', [
            'count' => $count,
        ]);
    }
}
