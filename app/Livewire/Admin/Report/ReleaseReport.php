<?php

namespace App\Livewire\Admin\Report;

use App\Models\Pdl;
use Livewire\Component;

class ReleaseReport extends Component
{
    public $search;
    public $date;
    public function render()
    {
        return view('livewire.admin.report.release-report',[
            'releases' => Pdl::where('status', 'release')
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
                $remand->whereDate('date_of_release', $this->date);
            })->get(),
        ]);
    }
}
