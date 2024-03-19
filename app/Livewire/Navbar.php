<?php

namespace App\Livewire;

use App\Models\AccountLogo;
use Livewire\Component;
use Livewire\WithFileUploads;
class Navbar extends Component
{
    use WithFileUploads;
    public $photo;
    public $upload_logo = false;

    public function saveLogo(){
        $data = AccountLogo::where('user_id', auth()->user()->id)->get();
        if ($data->count() > 0) {
            $data->first()->update([
                'logo_path' => $this->photo->store('AccountLogo', 'public'),
            ]);
        }else{
            AccountLogo::create([
                'user_id' => auth()->user()->id,
                'logo_path' => $this->photo->store('AccountLogo', 'public'),
            ]);
        }
        $this->upload_logo = false;
    }
    public function render()
    {
        return view('livewire.navbar');
    }
}
