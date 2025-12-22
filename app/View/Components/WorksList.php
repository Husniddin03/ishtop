<?php

namespace App\View\Components;

use App\Models\Work;
use Illuminate\View\Component;
use Illuminate\View\View;

class WorksList extends Component
{
    public $works;
    public function __construct()
    {
        $this->works = Work::all();
    }
    public function render(): View
    {
        return view('components.works-list');
    }
}
