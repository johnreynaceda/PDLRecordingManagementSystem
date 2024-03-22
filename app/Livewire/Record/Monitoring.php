<?php

namespace App\Livewire\Record;

use App\Models\Jail;
use App\Models\Pdl;
use Livewire\Attributes\On;
use Livewire\Component;

class Monitoring extends Component
{
    public $jail;
    public $populations, $commits, $hearings, $remands, $releases;
    public $labels, $counts;


    public function updatedJail(){
        $this->dispatch('chartUpdate');
    }

    #[On('chartUpdate')]
    public function chartUpdated(){

        $this->commits = Pdl::when($this->jail, function($jail){
            $jail->where('jail_id', $this->jail);
        })->whereHas('jail', function($record){
            $record->where('region_id', auth()->user()->region_id);
        })->count();
        $this->hearings = Pdl::when($this->jail, function($jail){
                $jail->where('jail_id', $this->jail);
            })->where('status', 'hearing')->whereHas('jail', function($record){
                $record->where('region_id', auth()->user()->region_id);
            })->count();

            $this->remands = Pdl::when($this->jail, function($jail){
                    $jail->where('jail_id', $this->jail);
                })->where('status','remand')->whereHas('jail', function($record){
                    $record->where('region_id', auth()->user()->region_id);
                })->count();

                 $this->releases = Pdl::when($this->jail, function($jail){
                         $jail->where('jail_id', $this->jail);
                     })->where('status','release')->whereHas('jail', function($record){
                         $record->where('region_id', auth()->user()->region_id);
                     })->count();

                     $this->labels = ['Commits', 'Hearings', 'Remands', 'Releases'];
                     $this->counts = [$this->commits, $this->hearings,$this->remands, $this->releases];

    }


    public function render()
    {
        $this->populations = Pdl::when($this->jail, function($jail){
                $jail->where('jail_id', $this->jail);
            })->whereHas('jail', function($record){
                $record->where('region_id', auth()->user()->region_id);
            })->count() - (Pdl::when($this->jail, function($jail){
                $jail->where('jail_id', $this->jail);
            })->when($this->jail, function($jail){
                $jail->where('jail_id', $this->jail);
            })->where('status','remand')->whereHas('jail', function($record){
                $record->where('region_id', auth()->user()->region_id);
            })->count() + Pdl::when($this->jail, function($jail){
                $jail->where('jail_id', $this->jail);
            })->when($this->jail, function($jail){
                $jail->where('jail_id', $this->jail);
            })->where('status','release')->whereHas('jail', function($record){
                $record->where('region_id', auth()->user()->region_id);
            })->count());


            $this->commits = Pdl::when($this->jail, function($jail){
                    $jail->where('jail_id', $this->jail);
                })->whereHas('jail', function($record){
                    $record->where('region_id', auth()->user()->region_id);
                })->count();
                $this->hearings = Pdl::when($this->jail, function($jail){
                        $jail->where('jail_id', $this->jail);
                    })->where('status', 'hearing')->whereHas('jail', function($record){
                        $record->where('region_id', auth()->user()->region_id);
                    })->count();

                    $this->remands = Pdl::when($this->jail, function($jail){
                            $jail->where('jail_id', $this->jail);
                        })->where('status','remand')->whereHas('jail', function($record){
                            $record->where('region_id', auth()->user()->region_id);
                        })->count();

                         $this->releases = Pdl::when($this->jail, function($jail){
                                 $jail->where('jail_id', $this->jail);
                             })->where('status','release')->whereHas('jail', function($record){
                                 $record->where('region_id', auth()->user()->region_id);
                             })->count();

                             $this->labels = ['Commits', 'Hearings', 'Remands', 'Releases'];
                             $this->counts = [$this->commits, $this->hearings,$this->remands, $this->releases];



        return view('livewire.record.monitoring',[
            'jails' =>  Jail::where('region_id', auth()->user()->region_id)->get(),
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
