<?php

namespace App\Livewire\Admin;

use App\Livewire\Admin\PdlList;
use App\Models\Pdl;
use Filament\Tables\Columns\ViewColumn;
use Livewire\Component;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Shop\Product;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class ReleaseList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(auth()->user()->user_type == 'superadmin' ? Pdl::query()->where('status', 'release') : Pdl::query()->where('status', 'release')->where('jail_id', auth()->user()->jail_id))
            ->columns([
                TextColumn::make('personalInformation.firstname')->label('FIRSTNAME'),
                TextColumn::make('personalInformation.lastname')->label('LASTNAME'),
                TextColumn::make('date_of_release')->date()->label('RELEASE DATE')->searchable(),
                TextColumn::make('criminal_case_no')->label('CRIMINAL CASE')->searchable(),
                TextColumn::make('court')->label('BRANCH OF COURT')->searchable(),
                TextColumn::make('date_of_confinement')->date()->label('CONFINEMENT DATE')->searchable(),
                ViewColumn::make('status')->label('COMMITTED CRIME')->view('filament.tables.columns.cases')
                ])
            ->filters([
                Filter::make('created_at')->indicator('Administrators')
                ->form([
                    DatePicker::make('created_from'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', $date),
                        );

                })
            ])
            ->actions([
                EditAction::make('edit')->color('success'),
                // ActionGroup::make([
                //     olAction::make('hearings')->icon('heroicon-s-cursor-arrow-ripple')->cor('info'),
                //     Action::make('remands')->icon('heroicon-s-cursor-arrow-ripple')->color('warning'),
                //     Action::make('release')->icon('heroicon-s-cursor-arrow-ripple')->color('success'),
                // ])
            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No Release yet!')->emptyStateDescription('Once you add Release Record, it will appear here.')->emptyStateIcon('heroicon-o-document-text');
    }
    public function render()
    {
        return view('livewire.admin.release-list');
    }
}
