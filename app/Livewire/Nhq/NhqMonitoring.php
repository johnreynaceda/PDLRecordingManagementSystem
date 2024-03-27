<?php

namespace App\Livewire\Nhq;

use App\Models\Jail;
use App\Models\Pdl;
use App\Models\Region;
use Livewire\Attributes\On;
use Livewire\Component;

class NhqMonitoring extends Component
{
    public $jail;
    public $populations, $commits, $hearings, $remands, $releases;
    public $labels, $counts;
    public $region;

    public function render()
    {
        $this->populations = Pdl::when($this->region, function($record){
            $record->whereHas('jail', function($k){
                $k->where('region_id', $this->region);
            });
        })->count() - (Pdl::when($this->region, function($record){
            $record->whereHas('jail', function($k){
                $k->where('region_id', $this->region);
            });
        })->where('status','remand')->count() + Pdl::when($this->region, function($record){
            $record->whereHas('jail', function($k){
                $k->where('region_id', $this->region);
            });
        })->where('status','release')->count());
        $this->commits = Pdl::when($this->region, function($record){
            $record->whereHas('jail', function($k){
                $k->where('region_id', $this->region);
            });
        })->count();
            $this->hearings = Pdl::when($this->region, function($record){
                $record->whereHas('jail', function($k){
                    $k->where('region_id', $this->region);
                });
            })->where('status', 'hearing')->count();

                $this->remands = Pdl::when($this->region, function($record){
                    $record->whereHas('jail', function($k){
                        $k->where('region_id', $this->region);
                    });
                })->where('status','remand')->count();

                     $this->releases = Pdl::when($this->region, function($record){
                        $record->whereHas('jail', function($k){
                            $k->where('region_id', $this->region);
                        });
                     })->where('status','release')->count();

                         $this->labels = ['Commits', 'Hearings', 'Remands', 'Releases'];
                         $this->counts = [$this->commits, $this->hearings,$this->remands, $this->releases];



        return view('livewire.nhq.nhq-monitoring',[
            'jails' =>  Jail::where('region_id', auth()->user()->region_id)->get(),
            'ordinary' => Pdl::where('classification', 'ORDINARY')->count(),
            'profiles' => Pdl::where('classification', 'HIGH PROFILE')->count(),
            'risks' => Pdl::where('classification', 'HIGH RISKS')->count(),
            'profile_risks' => Pdl::where('classification', 'HIGH PROFILE/HIGH RISK')->count(),
            'insular' => Pdl::where('classification', 'INSULAR PDL')->count(),
            'city' => Pdl::where('classification', 'CITY PDL')->count(),
            'municipal' => Pdl::where('classification', 'MUNICIPAL PDL')->count(),
            'regions' => Region::all(),
        ]);
    }
}
