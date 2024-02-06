<?php

namespace App\Livewire\Admin;

use App\Models\Crime;
use Livewire\Component;
use Livewire\WithPagination;

class AdminDashboard extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.admin.admin-dashboard',[
            'crimes' => Crime::paginate(12),
        ]);
    }
}
