<?php

namespace App\Livewire\Admin;
use App\Models\Crime;
use App\Models\Issuance;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class IssuanceList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    use WithFileUploads;

    public $open_modal = false;
    public $attachment;
    public function table(Table $table): Table
    {
        return $table
            ->query(Issuance::query()->where('jail_id', auth()->user()->jail_id))->headerActions([
            Action::make('add')->label('New Issuances')->icon('heroicon-o-plus')->action(
                fn() => $this->open_modal = true
            )
        ])
            ->columns([
               ViewColumn::make('name')->label('NAME')->view('filament.tables.columns.file'),
                TextColumn::make('created_at')->date()->label('UPLOADED DATE')->searchable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([

                DeleteAction::make('delete')->modalHeading('Delete Issuance'),
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function submitRecord(){
        foreach ($this->attachment as $key => $value) {
           $data = explode('.', $value->getClientOriginalName());
           Issuance::create([
            'jail_id' => auth()->user()->jail_id,
            'name' => $data[0],
            'file_path' => $value->storeAs('PDL Attachments', $value->getClientOriginalName(),'public'),
           ]);
        }
        $this->open_modal = false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('attachment')->label('Upload Attachment'),
            ]);

    }

    public function render()
    {
        return view('livewire.admin.issuance-list');
    }
}
