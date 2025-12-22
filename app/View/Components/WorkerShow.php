<?php

namespace App\View\Components;

use App\Models\Worker;
use Illuminate\View\Component;
use Illuminate\View\View;

class WorkerShow extends Component
{
    public $work;
    public function __construct($id)
    {
        $this->work = Worker::find($id);
    }
    public function render(): View
    {
        return view('components.worker-show');
    }
}
