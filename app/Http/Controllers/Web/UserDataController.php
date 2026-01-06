<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDataController extends Controller
{
    public function myads()
    {
        $works = Work::where('user_id', Auth::id())->paginate(12);
        return view('profile.myads', compact('works'));
    }
}
