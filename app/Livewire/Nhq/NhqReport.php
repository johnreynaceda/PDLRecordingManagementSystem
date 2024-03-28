<?php

namespace App\Livewire\Nhq;

use App\Models\Jail;
use App\Models\Pdl;
use Livewire\Component;

class NhqReport extends Component
{
    public $selected_report;
    public $jail;
    public $search;
    public $date;
    public function render()
    {
        return view('livewire.nhq.nhq-report',[
            'jails' => Jail::where('region_id', auth()->user()->region_id)->get(),
            'commits' => Pdl::when($this->jail, function($jail){
                $jail->where('jail_id', $this->jail_id);
            })->when($this->date, function($confinement){
                $confinement->whereDate('date_of_confinement', $this->date);
            })
            ->where(function ($query) {
                $query->whereHas(
                    'personalInformation',
                    function ($info) {
                        $info->where('firstname', 'like', '%'. $this->search. '%')
                            ->orWhere('lastname', 'like', '%'. $this->search. '%');
                    }
                )->where('classification', 'like', '%' . $this->search . '%')
                    ->orWhere('court', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%')
                    ->orWhere('remarks', 'like', '%' . $this->search . '%');
            })->get(),
            'hearings' => Pdl::where('status', 'hearing')->when($this->jail, function($jail){
                $jail->where('jail_id', $this->jail_id);
            }) ->when($this->search, function ($query) {
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
            'remands' => Pdl::where('status', 'remand')->when($this->jail, function($jail){
                $jail->where('jail_id', $this->jail_id);
            }) ->when($this->search, function ($query) {
                $query->whereHas('personalInformation', function ($info) {
                    $info->where('firstname', 'like', '%' . $this->search . '%')
                        ->orWhere('lastname', 'like', '%' . $this->search . '%');
                });
            })
            ->where(function ($query) {
                $query->where('classification', 'like', '%' . $this->search . '%')
                    ->orWhere('criminal_case_no', 'like', '%' . $this->search . '%')
                    ->orWhere('court', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%')
                    ->orWhere('cell_location', 'like', '%'. $this->search. '%');

            })->when($this->date, function($remand){
                $remand->whereDate('date_of_remand', $this->date);
            })->get(),
            'releases' => Pdl::where('status', 'release')->when($this->jail, function($jail){
                $jail->where('jail_id', $this->jail_id);
            }) ->when($this->search, function ($query) {
                $query->whereHas('personalInformation', function ($info) {
                    $info->where('firstname', 'like', '%' . $this->search . '%')
                        ->orWhere('lastname', 'like', '%' . $this->search . '%');
                });
            })
            ->where(function ($query) {
                $query->where('classification', 'like', '%' . $this->search . '%')
                    ->orWhere('criminal_case_no', 'like', '%' . $this->search . '%')
                    ->orWhere('court', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%')
                    ->orWhere('cell_location', 'like', '%'. $this->search. '%');

            })->when($this->date, function($remand){
                $remand->whereDate('date_of_release', $this->date);
            })->get(),
        ]);
    }
}
