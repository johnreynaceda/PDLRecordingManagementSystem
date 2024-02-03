<?php

namespace App\Livewire\Superadmin;

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
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Livewire\Component;
use Filament\Tables\Actions\EditAction;


class AccountList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query()->where('user_type', '!=', 'superadmin'))->headerActions([
                CreateAction::make('new')->label('New Account')->color('main')->size('sm')->icon('heroicon-s-plus')->action(
                    function(){
                        dd('dfdfd');
                    }
                )
            ])
            ->columns([
                TextColumn::make('name')->label('NAME')->searchable(),
                TextColumn::make('email')->label('EMAIL')->searchable(),
                TextColumn::make('user_type')->label('USER TYPE')->searchable(),
                TextColumn::make('jail.name')->label('JAIL BRANCH')->searchable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
               EditAction::make('edit')->color('success'),
               DeleteAction::make('delete'),
            ])
            ->bulkActions([
                // ...
            ])->emptyStateIcon('heroicon-s-table-cells')->emptyStateHeading('No Accounts yet!')->emptyStateDescription('Once you create new Account, it will appear here.');
    }

    public function render()
    {
        return view('livewire.superadmin.account-list');
    }
}
