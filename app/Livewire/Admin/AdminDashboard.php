<?php

namespace App\Livewire\Admin;

use App\Models\Crime;
use App\Models\Pdl;
use Livewire\Component;
use Livewire\WithPagination;

class AdminDashboard extends Component
{
    public $search;
    public $date;
    public $dates;
    use WithPagination;
    public function render()
    {
        return view('livewire.admin.admin-dashboard',[
            'crimes' => Crime::when($this->search, function($record){
                $record->where('name', 'like', '%'. $this->search. '%');
            })->paginate(12),

            'commits' => Pdl::when($this->date, function($record){
                $record->where('date_of_confinement', 'like', '%'. $this->date. '%');
            })->where('jail_id', auth()->user()->jail_id)->count(),
            'remands' => Pdl::when($this->date, function($record){
                $record->where('date_of_remand', 'like', '%'. $this->date. '%');
            })->where('status', 'remand')->where('jail_id', auth()->user()->jail_id)->count(),
            'releases' => Pdl::when($this->date, function($record){
                $record->where('date_of_release', 'like', '%'. $this->date. '%');
            })->where('status','release')->where('jail_id', auth()->user()->jail_id)->count(),

            'jails' => Pdl::when($this->date, function($record){
                $record->where('date_of_confinement', 'like', '%'. $this->date. '%');
            })->where('jail_id', auth()->user()->jail_id)->where('status', '!=', 'release')->count(),
        ]);
    }
}
