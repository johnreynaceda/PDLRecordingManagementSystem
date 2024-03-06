<?php

namespace App\Livewire\Admin;

use App\Livewire\Admin\PdlList;
use App\Models\Pdl;
use App\Models\PdlCases;
use App\Models\PdlHearing;
use Filament\Forms\Form;
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

class HearingList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    use Actions;


    public $view_cases = false;
    public $crime_data = [];
    public $date, $time, $hearing_id;
    public $edit_hearings = false;
    public function table(Table $table): Table
    {
        return $table
            ->query(auth()->user()->user_type == 'superadmin' ?  Pdl::query()->where('status', 'hearing') : Pdl::query()->where('status', 'hearing')->where('jail_id', auth()->user()->jail_id))
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
                ActionGroup::make([
                    Action::make('hearings')->label('Add Hearing Dates')->icon('heroicon-m-calendar-days')->color('info')->action(
                        function($record, $data){

                            PdlHearing::create([
                                'pdl_id' => $record->id,
                                'date_of_hearing' => Carbon::parse($data['date']),
                                'time_of_hearing' => Carbon::parse($data['time']),
                            ]);
                        }
                    )->form(
                        function($record){

                            return [
                        DatePicker::make('date'),
                        TimePicker::make('time')->seconds(false),

                            ];
                        })->modalWidth('xl'),
                    Action::make('remands')->icon('heroicon-s-cursor-arrow-ripple')->color('warning')->action(
                        function($record, $data){
                            $record->update([
                                'status' => 'remand',
                                'date_of_remand' => Carbon::parse( $data['date']),
                            ]);

                            $this->dialog()->success(
                                $title = 'Status updated',
                                $description = 'PDL infos are now in remand status.'

                            );
                        }
                    )->form([
                        DatePicker::make('date')->label('Date of Remand'),
                    ])->modalWidth('xl'),
                    Action::make('release')->icon('heroicon-s-cursor-arrow-ripple')->color('success')->action(
                        function($record, $data){
                            $record->update([
                                'status' => 'release',
                                'date_of_release' => Carbon::parse($data['date']),
                            ]);

                            $this->dialog()->success(
                                $title = 'Status updated',
                                $description = 'PDL infos are now in release status.'

                            );
                        }
                    )->form([

                        DatePicker::make('date')->label('Date of Release'),
                    ])->modalWidth('xl'),
                ])
            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No Hearings yet!')->emptyStateDescription('Once you add Hearings Record, it will appear here.')->emptyStateIcon('heroicon-o-document-text');
    }

    public function editHearing($id){
        $this->edit_hearings = true;
        $this->hearing_data = PdlHearing::where('id', $id)->first();
        $this->date = $this->hearing_data->date_of_hearing;
        $this->time = Carbon::parse($this->hearing_data->time_of_hearing);
        $this->hearing_id = $id;

    }



    public function deleteHearing($id){
        $hearing = PdlHearing::find($id);
        $hearing->delete();

        $this->dialog()->success(
            $title = 'Hearing deleted',
            $description = 'Date has been deleted.'

        );
    }

    public function updateHearing(){
       $data = PdlHearing::where('id', $this->hearing_id)->first();
       $data->update([
        'date_of_hearing' => Carbon::parse($this->date),
        'time_of_hearing' => Carbon::parse($this->time),
       ]);
       $this->edit_hearings = false;
       $this->dialog()->success(
        $title = 'Hearing update',
        $description = 'Date has been updated.'

    );
    }

    public function viewCommitedCrime($id){
        $this->crime_data = PdlCases::where('pdl_id', $id)->get();

        $this->view_cases = true;

    }

    public function render()
    {
        return view('livewire.admin.hearing-list');
    }
}
