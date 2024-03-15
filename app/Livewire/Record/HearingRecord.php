<?php

namespace App\Livewire\Record;

use Livewire\Component;
use App\Livewire\Admin\PdlList;
use App\Models\Pdl;
use App\Models\PdlCases;
use App\Models\PdlHearing;
use Filament\Forms\Form;
use Filament\Tables\Columns\ViewColumn;
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
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Forms\Components\ViewField;
use WireUi\Traits\Actions;
class HearingRecord extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    use Actions;

    public $view_cases = false;
    public $crime_data = [];
    public $date, $time, $hearing_id;

    public function table(Table $table): Table
    {
        return $table
            ->query(auth()->user()->user_type== 'records' ? Pdl::query()->where('status', 'hearing')->whereHas('jail', function($record){
                $record->where('region_id', auth()->user()->region_id);
            }) : Pdl::query()->where('status', 'hearing'))
            ->columns([
                TextColumn::make('id')->label('FULLNAME')->formatStateUsing(
                    function ($record) {
                        return $record->personalInformation->lastname. ', '. $record->personalInformation->firstname. ' '. ($record->personalInformation->middlename == null ? '' : $record->personalInformation->middlename) ;
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
                TextColumn::make('cell_location')->label('CELL/LOCAION')->searchable(),
                TextColumn::make('court')->label('BRANCH/COURT')->searchable(),
                TextColumn::make('jail.region.name')->label('REGION')->searchable()->visible(auth()->user()->user_type == 'superadmin'),
                ])
            ->filters([
                Filter::make('created_at')->indicator('Administrators')
                ->form([
                    DatePicker::make('created_from')->label('Date of Hearing'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn (Builder $query, $date): Builder => $query->whereHas('pdlHearings', function($record) use ($date){
                                $record->whereDate('date_of_hearing', $date);
                            })
                        );

                })
            ])
            ->actions([
                ViewAction::make('view')->label('view hearing dates')->icon('heroicon-s-calendar')->color('warning')->form(
                    function($record){
                        $this->edit_hearings = false;
                        return [
                                ViewField::make('rating')
                ->view('filament.forms.hearing_date')
                        ];

                    }
                )->modalHeading('Hearing Dates')->modalWidth('2xl'),

            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No Hearings yet!')->emptyStateDescription('Once you add Hearings Record, it will appear here.')->emptyStateIcon('heroicon-o-document-text');
    }

    public function render()
    {
        return view('livewire.record.hearing-record');
    }
}
