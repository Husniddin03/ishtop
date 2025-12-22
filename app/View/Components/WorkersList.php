<?php

namespace App\View\Components;

use App\Models\Worker;
use Illuminate\View\Component;
use Illuminate\View\View;

class WorkersList extends Component
{
    public $workers;
    public function __construct()
    {
        $this->workers = Worker::all();
    }
    public function render(): View
    {
        return view('components.workers-list');
    }
}
