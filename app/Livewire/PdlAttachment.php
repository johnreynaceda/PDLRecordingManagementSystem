<?php

namespace App\Livewire;

use App\Models\LogHistory;
use Filament\Forms\Components\FileUpload;
use Livewire\Attributes\On;
use App\Models\Post;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use WireUi\Traits\Actions;

class PdlAttachment extends Component implements HasForms
{
    use InteractsWithForms;
    use Actions;
    public $pdl_id;
    public $attachmentss = [];

    #[On('attachment')]
    public function handleAttachment($pdl_id){
        $this->pdl_id = $pdl_id;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
              FileUpload::make('attachmentss')->label('Upload Attachment')->multiple()->getUploadedFileNameForStorageUsing(
                fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                    ->prepend('custom-prefix-'),
            )
            ]);
    }

    public function submitAttachment(){
        $this->validate([
            'attachmentss' => 'required',
        ]);

        foreach ($this->attachmentss as $key => $value) {
            \App\Models\PdlAttachment::create([
                'pdl_id' => $this->pdl_id,
                'path' => $value->storeAs('PDL Attachments', $value->getClientOriginalName(),'public'),
            ]);
        }
        LogHistory::create([
            'pdl_id' => $this->pdl_id,
            'user_id' => auth()->user()->id,
            'description' => 'Upload Attachment',
            'type' => 'Upload',
        ]);
        $this->dialog()->success(
            $title = 'Attachment Added',
            $description = 'Attachment has been added.'
        );
        $this->reset('attachmentss');
        sleep(3);

    }


    public function render()
    {
        return view('livewire.pdl-attachment',[
            'attachments' => \App\Models\PdlAttachment::where('pdl_id',$this->pdl_id)->get(),
        ]);
    }
}
