<?php

namespace App\Livewire\Admin\Report;

use App\Models\Pdl;
use Livewire\Component;

class CommitReport extends Component
{
    public $search;
    public function render()
    {
        return view('livewire.admin.report.commit-report',[
            'commits' => Pdl::where('jail_id', auth()->user()->jail->id)->when($this->search, function($record){
                $record->whereHas('personalInformation', function($personal){
                    $personal->where('firstname', 'like', '%'. $this->search. '%')->orWhere('lastname', 'like', '%'. $this->search. '%');
                });
            })->where('classification', 'like', '%'. $this->search. '%')->orWhere('court', 'like', '%'. $this->search. '%')->orWhere('status', 'like', '%'. $this->search. '%')->orWhere('remarks', 'like', '%'. $this->search. '%')->get(),
        ]);
    }
}
