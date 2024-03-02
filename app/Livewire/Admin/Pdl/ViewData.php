<?php

namespace App\Livewire\Admin\Pdl;

use App\Models\EmergencyContact;
use App\Models\Pdl;
use App\Models\PdlCases;
use Livewire\Component;

class ViewData extends Component
{
    public $pdl_id;
    public function mount(){
        $this->pdl_id = request('id');
    }

    public function render()
    {
       
        return view('livewire.admin.pdl.view-data',[
            'pdls' => Pdl::where('id', $this->pdl_id)->first(),
            'crime_data' => PdlCases::where('pdl_id', $this->pdl_id)->get(),
            'contacts' => EmergencyContact::where('pdl_id', $this->pdl_id)->get(),
        ]);
    }
}
