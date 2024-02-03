<?php

namespace App\Livewire\Superadmin;

use App\Models\Jail;
use App\Models\Region;
use App\Models\Shop\Product;
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

class JailList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Jail::query())->headerActions([
                CreateAction::make('new')->label('New Jail Branch')->color('main')->size('sm')->icon('heroicon-s-plus')->form([
                    TextInput::make('name'),
                    Select::make('region_id')->label('Region')->options(
                        Region::all()->pluck('name','id')
                    )
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
                    function($record){
                        dd($record);
                    }
                )->form([
                    Grid::make(2)->schema([
                        
                        TextInput::make('name'),
                        TextInput::make('email')->email(),
                        TextInput::make('password')->email(),
                        Select::make('user_type')->options([
                            'admin' => 'Branch Admin',
                            'records' => 'Record Section',
                        ])
                    ])
                ])->modalWidth('2xl'),
               EditAction::make('edit')->color('success'),
               DeleteAction::make('delete'),
            ])
            ->bulkActions([
            ])->emptyStateIcon('heroicon-s-table-cells')->emptyStateHeading('No Jail Branch yet!')->emptyStateDescription('Once you create new Jail branch, it will appear here.');
    }

    public function render()
    {
        return view('livewire.superadmin.jail-list');
    }
}
