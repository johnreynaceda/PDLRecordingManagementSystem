<?php

namespace App\Livewire\Superadmin;

use App\Models\Crime;
use App\Models\Region;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class RegionList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Region::query())->headerActions([
            CreateAction::make('add')->label('New Region')->icon('heroicon-o-plus')->form([
                TextInput::make('name')->required()->unique(),
            ])->modalWidth('xl')->modalHeading('Create new Region'),
        ])
            ->columns([
                TextColumn::make('name')->label('NAME')->searchable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')->color('success')->form([
                    TextInput::make('name')->required(),
                ])->modalWidth('xl')->modalHeading('Update Region'),
                DeleteAction::make('delete')->modalHeading('Delete Region'),
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.superadmin.region-list');
    }
}
