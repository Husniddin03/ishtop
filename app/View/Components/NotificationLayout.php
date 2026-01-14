<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Illuminate\View\View;

class NotificationLayout extends Component
{
    public $notifications;
    public function __construct()
    {
        $user = Auth::user();
        if($user->notifications == true){
            
        }
    }
    public function render(): View
    {
        return view('components.notification-layout');
    }
}
