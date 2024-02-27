<?php

namespace App\Livewire\Admin;

use App\Livewire\Admin\PdlList;
use App\Models\Pdl;
use App\Models\PdlCases;
use App\Models\PdlHearing;
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
    public function table(Table $table): Table
    {
        return $table
            ->query(auth()->user()->user_type == 'superadmin' ?  Pdl::query()->where('status', 'hearing') : Pdl::query()->where('status', 'hearing')->where('jail_id', auth()->user()->jail_id))
            ->columns([
                TextColumn::make('personalInformation.firstname')->label('FIRSTNAME')->searchable(),
                TextColumn::make('personalInformation.lastname')->label('LASTNAME')->searchable(),
                // TextColumn::make('date_of_hearing')->date()->label('HEARING DATE')->searchable(),
                TextColumn::make('criminal_case_no')->label('CRIMINAL CASE NO.')->searchable(),
                // TextColumn::make('court')->label('BRANCH OF COURT')->searchable(),
                // TextColumn::make('date_of_confinement')->date()->label('COMMITTED DATE')->searchable(),
                ViewColumn::make('status')->label('CRIME COMMITTED')->view('filament.tables.columns.cases'),
                TextColumn::make('court')->label('BRANCH COURT')->searchable(),
                TextColumn::make('date_of_hearing')->date()->label('HEARING DATE')->searchable(),
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
                ViewAction::make('view')->label('view hearing dates')->icon('heroicon-s-calendar')->color('warning')->form(
                    function($record){
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
                                'morning_time' => Carbon::parse($data['morning_time']),
                                'afternoon_time' => Carbon::parse($data ['afternoon_time']),
                            ]);
                        }
                    )->form([
                        DatePicker::make('date'),
                        TimePicker::make('morning_time')->seconds(false),
                        TimePicker::make('afternoon_time')->seconds(false),
                    ])->modalWidth('xl'),
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

    public function viewCommitedCrime($id){
        $this->crime_data = PdlCases::where('pdl_id', $id)->get();

        $this->view_cases = true;

    }

    public function render()
    {
        return view('livewire.admin.hearing-list');
    }
}
