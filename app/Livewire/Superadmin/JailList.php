<?php

namespace App\Livewire\Superadmin;

use App\Models\Jail;
use App\Models\Region;
use App\Models\Shop\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use App\Models\User;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Livewire\Component;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\ViewField;

class JailList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $logo;
    public $name, $region_id;

    public function table(Table $table): Table
    {
        return $table
            ->query(Jail::query())->headerActions([
                CreateAction::make('new')->label('New Jail Branch')->color('main')->size('sm')->icon('heroicon-s-plus')->action(
                    function($data){
                        Jail::create([
                            'name' => $data['name'],
                          'region_id' => $data['region_id'],
                          'logo_path' => $this->logo->store('Branch Logo', 'public'),
                        ]);
                    }
                )->form([
                    TextInput::make('name'),
                    Select::make('region_id')->label('Region')->options(
                        Region::all()->pluck('name', 'id')
                    ),
                    ViewField::make('logo')->label('logo')->view('filament.forms.logo'),
                ])->modalWidth('xl'),
            ])
            ->columns([
                TextColumn::make('name')->label('NAME')->searchable(),
                TextColumn::make('region.name')->label('REGION')->searchable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                Action::make('assign')->label('Assign Account')->color('main')->icon('heroicon-s-user-plus')->action(
                    function ($record, $data) {
                       User::create([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password' => bcrypt($data['password']),
                        'user_type' => $data['user_type'],
                        'jail_id' => $record->id,
                       ]);
                    }
                )->form([
                    ViewField::make('rating')
                        ->view('filament.forms.jail'),
                    Grid::make(2)->schema([

                        TextInput::make('name'),
                        TextInput::make('email')->email(),
                        TextInput::make('password')->password(),
                        Select::make('user_type')->options([
                            'admin' => 'Branch Admin',
                            'records' => 'Record Section',
                        ])
                    ])
                ])->modalWidth('2xl'),
                EditAction::make('edit')->color('success'),
                DeleteAction::make('delete'),
            ])
            ->bulkActions([])->emptyStateIcon('heroicon-s-table-cells')->emptyStateHeading('No Jail Branch yet!')->emptyStateDescription('Once you create new Jail branch, it will appear here.');
    }

    public function render()
    {
        return view('livewire.superadmin.jail-list');
    }
}
