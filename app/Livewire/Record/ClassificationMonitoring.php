<?php

namespace App\Livewire\Record;

use App\Models\Pdl;
use Livewire\Component;

class ClassificationMonitoring extends Component
{
    public function render()
    {
        return view('livewire.record.classification-monitoring',[
            'ordinary' => Pdl::where('classification', 'ORDINARY')->whereHas('jail', function($record){
                $record->where('region_id', auth()->user()->region_id);
            })->count(),
            'profiles' => Pdl::where('classification', 'HIGH PROFILE')->whereHas('jail', function($record){
                $record->where('region_id', auth()->user()->region_id);
            })->count(),
            'risks' => Pdl::where('classification', 'HIGH RISKS')->whereHas('jail', function($record){
                $record->where('region_id', auth()->user()->region_id);
            })->count(),
            'profile_risks' => Pdl::where('classification', 'HIGH PROFILE/HIGH RISK')->whereHas('jail', function($record){
                $record->where('region_id', auth()->user()->region_id);
            })->count(),
            'insular' => Pdl::where('classification', 'INSULAR PDL')->whereHas('jail', function($record){
                $record->where('region_id', auth()->user()->region_id);
            })->count(),
            'city' => Pdl::where('classification', 'CITY PDL')->whereHas('jail', function($record){
                $record->where('region_id', auth()->user()->region_id);
            })->count(),
            'municipal' => Pdl::where('classification', 'MUNICIPAL PDL')->whereHas('jail', function($record){
                $record->where('region_id', auth()->user()->region_id);
            })->count(),
        ]);
    }
}
