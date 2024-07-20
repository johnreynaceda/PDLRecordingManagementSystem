<?php

namespace App\Livewire\Admin\Report;

use App\Models\Pdl;
use App\Models\Region;
use Livewire\Component;

class CommitReport extends Component
{
    public $search;
    public $date;
    public $region;
    public function render()
    {
        return view('livewire.admin.report.commit-report', [
            'commits' => auth()->user()->user_type == 'admin' ? Pdl::where('jail_id', auth()->user()->jail->id)
            ->when($this->date, function($confinement) {
                $confinement->whereDate('date_of_confinement', $this->date);
            })
            ->where(function ($query) {
                $query->whereHas('personalInformation', function ($info) {
                    $info->where('firstname', 'like', '%'. $this->search. '%')
                        ->orWhere('lastname', 'like', '%'. $this->search. '%');
                })
                ->orWhere('classification', 'like', '%' . $this->search . '%')
                ->orWhere('court', 'like', '%' . $this->search . '%')
                ->orWhere('status', 'like', '%' . $this->search . '%')
                ->orWhere('remarks', 'like', '%' . $this->search . '%');
            })
            ->get() : Pdl::when($this->region, function($record) {
                $record->whereHas('jail', function($jail) {
                    $jail->where('region_id', $this->region);
                });
            })
            ->where(function ($query) {
                $query->whereHas('personalInformation', function ($info) {
                    $info->where('firstname', 'like', '%'. $this->search .'%')
                        ->orWhere('lastname', 'like', '%'. $this->search .'%');
                })
                ->orWhere('classification', 'like', '%' . $this->search . '%')
                ->orWhere('court', 'like', '%' . $this->search . '%')
                ->orWhere('status', 'like', '%' . $this->search . '%')
                ->orWhere('remarks', 'like', '%' . $this->search . '%');
            })
            ->get(),
            'regions' => Region::all(),
        ]);
    }
}
