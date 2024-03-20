<?php

namespace App\Livewire\Admin\Report;

use App\Models\Pdl;
use Livewire\Component;

class CommitReport extends Component
{
    public $search;
    public $date;
    public function render()
    {
        return view('livewire.admin.report.commit-report', [
            'commits' => Pdl::where('jail_id', auth()->user()->jail->id)->when($this->date, function($confinement){
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
            })

            ->get(),
        ]);
    }
}
