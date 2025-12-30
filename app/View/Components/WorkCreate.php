<?php

namespace App\View\Components;

use App\Models\Region;
use Illuminate\View\Component;
use Illuminate\View\View;

class WorkCreate extends Component
{
    public $regions;
    public function __construct()
    {
        $this->regions = Region::with(['districts.villages'])->get();
    }
    public function render(): View
    {
        return view('components.work-create');
    }
}
