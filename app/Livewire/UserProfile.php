<?php

namespace App\Livewire;

use App\Models\Post;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class UserProfile extends Component implements HasForms
{
    use InteractsWithForms;
    public $profile = [];

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('profile')
            ]);
    }

    public function uploadProfile(){
     $data = \App\Models\UserProfile::where('user_id', auth()->user()->id)->first();
     if ($data != null) {
        if ($data->count() > 0) {
            foreach ($this->profile as $key => $value) {
                $data->update([
                    'path' => $value->store('User Prfile', 'public'),
                ]);
             }
         }else{
            foreach ($this->profile as $key => $value) {
                \App\Models\UserProfile::create([
                    'user_id' => auth()->user()->id,
                    'path' => $value->store('User Prfile', 'public'),
                ]);
             }
         }
     }else{
        foreach ($this->profile as $key => $value) {
            \App\Models\UserProfile::create([
                'user_id' => auth()->user()->id,
                'path' => $value->store('User Profile', 'public'),
            ]);
         }
     }
     return redirect()->route('dashboard');
    }
    public function render()
    {
        return view('livewire.user-profile');
    }
}
