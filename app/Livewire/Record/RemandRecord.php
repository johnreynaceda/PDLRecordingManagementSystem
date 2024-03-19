<?php

namespace App\Livewire\Record;

use App\Livewire\Admin\PdlList;
use App\Models\Jail;
use App\Models\Pdl;
use App\Models\PdlCases;
use App\Models\Region;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\SelectFilter;
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
use Carbon\Carbon;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use WireUi\Traits\Actions;


class RemandRecord extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    use Actions;

    public $view_cases = false;
    public $crime_data = [];

    public function table(Table $table): Table
    {
        return $table
            ->query(auth()->user()->user_type== 'records' ? Pdl::query()->where('status', 'remand')->whereHas('jail', function($record){
                $record->where('region_id', auth()->user()->region_id);
            }) : Pdl::query()->where('status', 'remand'))
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
                TextColumn::make('criminal_case_no')->label('CRIMINAL CASE NO.')->searchable(),
                ViewColumn::make('crime')->label('CRIME COMMITTED')->view('filament.tables.columns.crime-committed')->searchable(
                    query: function (Builder $query, string $search): Builder {
                        return $query->whereHas('pdlcases', function($record) use ($search){
                            $record->whereHas('crime', function($k) use ($search){
                                $k->where('name', 'LIKE', '%'.$search.'%');
                            });
                        });
                    }
                ),
                TextColumn::make('cell_location')->label('CELL/LOCATION')->searchable(),
                TextColumn::make('court')->label('BRANCH/COURT')->searchable(),
                TextColumn::make('date_of_remand')->date()->label('REMAND DATE')->searchable(),
                TextColumn::make('jail.region.name')->label('REGION')->searchable()->visible(auth()->user()->user_type == 'superadmin'),

                ])
            ->filters([
                SelectFilter::make('jail_id')->label('Jail')
                ->options(Jail::pluck('name', 'id'))->visible(auth()->user()->user_type == 'records'),
                SelectFilter::make('region_id')->label('Region')
                ->options(Region::pluck('name', 'id'))->visible(auth()->user()->user_type == 'nhq'),
            ])
            ->actions([

            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No Remands yet!')->emptyStateDescription('Once you add Remands Record, it will appear here.')->emptyStateIcon('heroicon-o-document-text');
    }
    public function render()
    {
        return view('livewire.record.remand-record');
    }
}
