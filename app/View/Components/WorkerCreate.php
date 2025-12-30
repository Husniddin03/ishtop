<?php

namespace App\View\Components;

use App\Models\Region;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Illuminate\View\View;

class WorkerCreate extends Component
{
    public $regions;
    public $userData;
    public $userContact;
    public function __construct()
    {
        $this->regions = Region::with(['districts.villages'])->get();
        $user = Auth::user();
        if (!$user instanceof User) {
            throw new \Exception('Authenticated user is not an instance of the User model.');
        }

        $this->userData = $user->userData;
        $this->userContact = $user->userContact;
    }
    public function render(): View
    {
        return view('components.worker-create');
    }
}
