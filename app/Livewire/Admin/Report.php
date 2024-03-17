<?php

namespace App\Livewire\Admin;

use App\Models\Pdl;
use Livewire\Attributes\On;
use Livewire\Component;

class Report extends Component
{
    public $selected_report;
    public $populations, $commits, $hearings, $remands, $releases;
    public $labels, $counts;

    public function updatedSelectedReport(){
        $this->dispatch('chartUpdate');
    }

    #[On('chartUpdate')]
    public function chartUpdated(){

        $this->commits = Pdl::where('jail_id', auth()->user()->jail_id)->count();
        $this->hearings = Pdl::where('jail_id', auth()->user()->jail_id)->where('status', 'hearing')->count();

            $this->remands = Pdl::where('jail_id', auth()->user()->jail_id)->where('status','remand')->count();

                 $this->releases = Pdl::where('jail_id', auth()->user()->jail_id)->where('status','release')->count();

                     $this->labels = ['Commits', 'Hearings', 'Remands', 'Releases'];
                     $this->counts = [$this->commits, $this->hearings,$this->remands, $this->releases];

    }

    public function render()
    {
        $this->commits = Pdl::where('jail_id', auth()->user()->jail_id)->count();
        $this->hearings = Pdl::where('jail_id', auth()->user()->jail_id)->where('status', 'hearing')->count();

            $this->remands = Pdl::where('jail_id', auth()->user()->jail_id)->where('status','remand')->count();

                 $this->releases = Pdl::where('jail_id', auth()->user()->jail_id)->where('status','release')->count();

                     $this->labels = ['Commits', 'Hearings', 'Remands', 'Releases'];
                     $this->counts = [$this->commits, $this->hearings,$this->remands, $this->releases];

        return view('livewire.admin.report',[
            'ordinary' => Pdl::where('classification', 'ORDINARY')->where('jail_id', auth()->user()->jail_id)->count(),
            'profiles' => Pdl::where('classification', 'HIGH PROFILE')->where('jail_id', auth()->user()->jail_id)->count(),
            'risks' => Pdl::where('classification', 'HIGH RISKS')->where('jail_id', auth()->user()->jail_id)->count(),
            'profile_risks' => Pdl::where('classification', 'HIGH PROFILE/HIGH RISK')->where('jail_id', auth()->user()->jail_id)->count(),
            'insular' => Pdl::where('classification', 'INSULAR PDL')->where('jail_id', auth()->user()->jail_id)->count(),
            'city' => Pdl::where('classification', 'CITY PDL')->where('jail_id', auth()->user()->jail_id)->count(),
            'municipal' => Pdl::where('classification', 'MUNICIPAL PDL')->where('jail_id', auth()->user()->jail_id)->count(),
        ]);
    }
}
