<?php

namespace App\Livewire\Admin;

use App\Models\Crime;
use App\Models\Pdl;
use Livewire\Component;
use Livewire\WithPagination;

class AdminDashboard extends Component
{
    public $search;
    public $date_from;
    public $date_to;

    public $dates;
    use WithPagination;
    public function render()
    {
        return view('livewire.admin.admin-dashboard',[
            'crimes' => Crime::when($this->search, function($record){
                $record->where('name', 'like', '%'. $this->search. '%');
            })->paginate(12),

            'commits' => Pdl::when($this->date_from, function($record){
                $record->whereBetween('date_of_confinement', [$this->date_from, $this->date_to]);
            })->where('jail_id', auth()->user()->jail_id)->count(),

            'remands' => Pdl::when($this->date_from, function($record){
                $record->whereBetween('date_of_remand', [$this->date_from, $this->date_to]);
            })->where('status', 'remand')->where('jail_id', auth()->user()->jail_id)->count(),

            'releases' => Pdl::when($this->date_from, function($record){
                $record->whereBetween('date_of_release', [$this->date_from, $this->date_to]);
            })->where('status', 'release')->where('jail_id', auth()->user()->jail_id)->count(),

            'jails' => Pdl::when($this->date_from, function($record){
                $record->whereBetween('date_of_confinement', [$this->date_from, $this->date_to]);
            })->where('jail_id', auth()->user()->jail_id)->count() - (
                Pdl::when($this->date_from, function($record){
                    $record->whereBetween('date_of_remand', [$this->date_from, $this->date_to]);
                })->where('status', 'remand')->where('jail_id', auth()->user()->jail_id)->count() + Pdl::when($this->date_from, function($record){
                    $record->whereBetween('date_of_release', [$this->date_from, $this->date_to]);
                })->where('status', 'release')->where('jail_id', auth()->user()->jail_id)->count()
            )
        ]);
    }

    public function totalJail(){

    }
}
