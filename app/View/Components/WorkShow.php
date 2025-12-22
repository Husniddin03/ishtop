<?php

namespace App\View\Components;

use App\Models\Work;
use Illuminate\View\Component;
use Illuminate\View\View;

class WorkShow extends Component
{
    public $work;
    public function __construct($id)
    {
        $this->work = Work::find($id);
    }
    public function render(): View
    {
        return view('components.work-show');
    }
}
