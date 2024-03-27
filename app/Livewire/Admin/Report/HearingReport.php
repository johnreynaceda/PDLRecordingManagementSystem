<?php

namespace App\Livewire\Admin\Report;

use App\Models\Pdl;
use App\Models\Region;
use Livewire\Component;

class HearingReport extends Component
{
    public $search;
    public $date;

    public $region;

    public function render()
    {
        return view('livewire.admin.report.hearing-report',[
            'hearings' => auth()->user()->user_type == 'admin' ? Pdl::where('status', 'hearing')
            ->where('jail_id', auth()->user()->jail->id)
            ->when($this->search, function ($query) {
                $query->whereHas('personalInformation', function ($info) {
                    $info->where('firstname', 'like', '%' . $this->search . '%')
                        ->orWhere('lastname', 'like', '%' . $this->search . '%');
                });
            })
            ->where(function ($query) {
                $query->where('classification', 'like', '%' . $this->search . '%')
                    ->orWhere('criminal_case_no', 'like', '%' . $this->search . '%')
                    ->orWhere('court', 'like', '%' . $this->search . '%')
                    ->orWhere('cell_location', 'like', '%' . $this->search . '%');
            })
            ->when($this->date, function ($query) {
                $query->whereHas('pdlHearings', function ($hearing) {
                    $hearing->whereDate('date_of_hearing', $this->date);
                });
            })
            ->get() : Pdl::when($this->region, function($record){
                $record->whereHas('jail', function($jail){
                    $jail->where('region_id', $this->region);
                });
            })->when($this->search, function ($query) {
                $query->whereHas('personalInformation', function ($info) {
                    $info->where('firstname', 'like', '%' . $this->search . '%')
                        ->orWhere('lastname', 'like', '%' . $this->search . '%');
                });
            })
            ->where(function ($query) {
                $query->where('classification', 'like', '%' . $this->search . '%')
                    ->orWhere('criminal_case_no', 'like', '%' . $this->search . '%')
                    ->orWhere('court', 'like', '%' . $this->search . '%')
                    ->orWhere('cell_location', 'like', '%' . $this->search . '%');
            })
            ->when($this->date, function ($query) {
                $query->whereHas('pdlHearings', function ($hearing) {
                    $hearing->whereDate('date_of_hearing', $this->date);
                });
            })->get(),
            'regions' => Region::all(),
        ]);
    }
}
