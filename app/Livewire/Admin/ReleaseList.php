<?php

namespace App\Livewire\Admin;

use App\Livewire\Admin\PdlList;
use App\Models\Pdl;
use App\Models\PdlCases;
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

    public $view_cases = false;
    public $crime_data = [];
    public function table(Table $table): Table
    {
        return $table
            ->query(auth()->user()->user_type == 'superadmin' ? Pdl::query()->where('status', 'release') : Pdl::query()->where('status', 'release')->where('jail_id', auth()->user()->jail_id))
            ->columns([
                TextColumn::make('id')->label('FULLNAME')->formatStateUsing(
                    function ($record) {
                        return $record->personalInformation->lastname. ', '. $record->personalInformation->firstname. ' '. ($record->personalInformation->middlename == null ? '' : $record->personalInformation->middlename[0].'.') ;
                    }
                )->searchable(query: function (Builder $query, string $search): Builder {
                    return $query->whereHas('personalInformation', function($record) use ($search){
                        return $record->where('firstname', 'LIKE', '%'.$search.'%')->orWhere('lastname', 'LIKE', '%'.$search.'%')->orWhere('middlename', 'LIKE', '%'. $search. '%');
                    });
                }),
                TextColumn::make('classification')->label('CLASSIFICATION')->searchable(),
                TextColumn::make('date_of_confinement')->date()->label('DATE COMMITED')->searchable(),
                ViewColumn::make('crime')->label('CRIME COMMITTED')->view('filament.tables.columns.crime-committed')->searchable(
                    query: function (Builder $query, string $search): Builder {
                        return $query->whereHas('pdlcases', function($record) use ($search){
                            $record->whereHas('crime', function($k) use ($search){
                                $k->where('name', 'LIKE', '%'.$search.'%');
                            });
                        });
                    }
                ),
                TextColumn::make('court')->label('BRANCH/COURT')->searchable(),
                TextColumn::make('status')->label('STATUS')->searchable(),
                TextColumn::make('remarks')->label('REMARKS')->searchable(),
                TextColumn::make('date_of_release')->date()->label('RELEASE DATE')->searchable(),
                TextColumn::make('jail.region.name')->label('REGION')->searchable()->visible(auth()->user()->user_type == 'superadmin'),
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
                // EditAction::make('edit')->color('success'),
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

    public function viewCommitedCrime($id){
        $this->crime_data = PdlCases::where('pdl_id', $id)->get();

        $this->view_cases = true;

    }
    public function render()
    {
        return view('livewire.admin.release-list');
    }
}
