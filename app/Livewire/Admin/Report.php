<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Report extends Component
{
    public $selected_report;
    public function render()
    {
        return view('livewire.admin.report');
    }
}
