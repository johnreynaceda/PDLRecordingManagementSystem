<?php

namespace App\Livewire\Admin\Report;

use App\Models\Pdl;
use Livewire\Component;

class RemandReport extends Component
{
    public $search;
    public $date;
    public function render()
    {
        return view('livewire.admin.report.remand-report',[
            'remands' => Pdl::where('status', 'remand')
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
                    ->orWhere('status', 'like', '%' . $this->search . '%')
                    ->orWhere('cell_location', 'like', '%'. $this->search. '%');

            })->when($this->date, function($remand){
                $remand->whereDate('date_of_remand', $this->date);
            })->get(),
        ]);
    }
}