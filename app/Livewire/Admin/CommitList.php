<?php

namespace App\Livewire\Admin;

use App\Models\Crime;
use App\Models\EmergencyContact;
use App\Models\Jail;
use App\Models\Pdl;
use App\Models\PdlCases;
use Carbon\Carbon;
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
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use App\Models\Shop\Product;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use WireUi\Traits\Actions;
use Filament\Forms\Components\ViewField;
use Filament\Tables\Columns\ViewColumn;

class CommitList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    use Actions;
    public $pdl_data;
    public $view_cases = false;
    public $view_modal = false;

    public $crime_data = [];
    public $contacts = [];

    public function table(Table $table): Table
    {
        return $table
            ->query(auth()->user()->user_type == 'superadmin' ? Pdl::query() : Pdl::query()->where('jail_id', auth()->user()->jail_id))->headerActions([
               Action::make('new_record')->icon('heroicon-o-plus')->icon('heroicon-o-plus')->color('success')->action(
                function(){
                    return redirect()->route('admin.commits.add');
                }
               )->hidden(auth()->user()->user_type == 'superadmin')
            ])
            ->columns([
                TextColumn::make('personalInformation.firstname')->label('FIRSTNAME')->searchable(),
                TextColumn::make('personalInformation.lastname')->label('LASTNAME')->searchable(),
                TextColumn::make('classification')->label('CLASSIFICATION')->searchable(),
                TextColumn::make('date_of_confinement')->date()->label('DATE COMMITED')->searchable(),
                ViewColumn::make('status')->label('COMMITTED CRIME')->view('filament.tables.columns.cases'),
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

                }),
                SelectFilter::make('jail')
    ->options(Jail::pluck('name', 'id'))
            ])
            ->actions([
                Action::make('view_data')->icon('heroicon-s-folder-open')->color('warning')->action(
                    function($record){
                        $this->pdl_data = $record;
                        $this->crime_data = PdlCases::where('pdl_id', $record->id)->get();
                        $this->contacts = EmergencyContact::where('pdl_id', $record->id)->get();
                        $this->view_modal = true;
                    }
                ),
                EditAction::make('edit')->color('success')->form([
                    Fieldset::make('')->schema([

                        DatePicker::make('date_arrested'),
                        TextInput::make('criminal_case_no'),
                        DatePicker::make('date_of_confinement')->label('Date Commited'),
                        TextInput::make('court'),
                        TextInput::make('time'),
                        Select::make('crime_commited')->multiple()->searchable()->options(Crime::all()->pluck('name', 'id')),
                        Select::make('classification')->options([
                            'HIGH RISKS' => 'HIGH RISKS',
                            'HIGH PROFILE' => 'HIGH PROFILE',
                            'HIGH PROFILE/HIGH RISK' => 'HIGH PROFILE/HIGH RISK',
                            'INSULAR PDL' => 'INSULAR PDL',
                            'CITY PDL' => 'CITY PDL',
                            'MUNICIPAL PDL' => 'MUNICIPAL PDL',
                            'ORDINARY' => ' ORDINARY',
                        ])->required(),
                    ])->columns(3),

                    Fieldset::make('PERSONAL INFORMATION')->schema([
                        TextInput::make('firstname')->label('Firstname'),
                        TextInput::make('middlename')->label('Middlename'),
                        TextInput::make('lastname')->label('Lastname'),
                        DatePicker::make('birthdate')->label('Birthdate'),
                        TextInput::make('birthplace')->label('Birthplace'),
                        TextInput::make('residence')->label('Residence'),
                        TextInput::make('civil_status')->label('Civil Status'),
                        Select::make('sex')->options([
                            'Male' => 'Male',
                            'Female' => 'Female',
                        ]),
                        TextInput::make('no_of_children')->label('No. of Children'),
                        TextInput::make('blood_type')->label('Blood Type'),
                    ])->columns(3),
                    Fieldset::make('FATHER INFORMATION')->schema([
                        TextInput::make('father_name')->label('Name'),
                        TextInput::make('father_address')->label('Address'),
                        TextInput::make('father_birthplace')->label('Birthplace'),
                        TextInput::make('father_occupation')->label('Occupation'),
                    ])->columns(4),
                    Fieldset::make('MOTHER INFORMATION')->schema([
                        TextInput::make('mother_name')->label('Name'),
                        TextInput::make('mother_address')->label('Address'),
                        TextInput::make('mother_birthplace')->label('Birthplace'),
                        TextInput::make('mother_occupation')->label('Occupation'),
                    ])->columns(4),

                    Grid::make(4)->schema([
                        TextInput::make('spouse_name')->label('Spouse Name'),
                        TextInput::make('spouse_occupation')->label('Spouse Occupation'),

                        TextInput::make('first_relative')->label('First Relative'),
                        TextInput::make('relationship')->label('Relationship'),
                        TextInput::make('relative_address')->label('Address')->columnSpan(2),
                    ]),
                    Fieldset::make('PERSONAL DESCRIPTION')->schema([
                        TextInput::make('age')->label('Age'),
                        TextInput::make('height'),
                        TextInput::make('weight'),
                        TextInput::make('build'),
                        TextInput::make('complexion'),
                        TextInput::make('hair'),
                        TextInput::make('eyes'),
                        TextInput::make('religion'),
                        TextInput::make('occupation'),
                        TextInput::make('attaintment'),
                        TextInput::make('nationality'),
                        TextInput::make('aliases'),
                        TextInput::make('register_voter'),
                        TextInput::make('brgy_registration'),
                        TextInput::make('language')->label('Language/Dialects Spoken'),
                        TextInput::make('skills'),
                        TextInput::make('returning_rate'),
                        TextInput::make('sentence'),
                    ])->columns(3),
                    Fieldset::make('OTHER RELATIVE TO BE CONTACTED/NOTED IN CASE OF EMERGENCY')->schema([
                        Repeater::make('contacts')->label('')->schema([
                            TextInput::make('contact_name'),
                            TextInput::make('contact_relationship'),
                            TextInput::make('contact_address'),
                            TextInput::make('contact_number'),
                        ])->columns(2)->columnSpan(2)->addActionLabel('Add additional information')->defaultItems(1),
                    ]),
                ])->modalWidth('6xl'),
                ActionGroup::make([
                    Action::make('hearings')->icon('heroicon-s-cursor-arrow-ripple')->color('info')->action(
                        function($record, $data){
                            $record->update([
                                'status' => 'hearing',
                                // 'date_of_hearing' => Carbon::parse($data['date']),
                            ]);

                            $this->dialog()->success(
                                $title = 'Status updated',
                                $description = 'PDL infos are now in hearing status.'
                            );
                        }
                    ),
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
                        ViewField::make('data')
                        ->view('filament.forms.pdl'),
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
            ])->emptyStateDescription('Once you add PDL Record, it will appear here.')->emptyStateIcon('heroicon-o-document-text');
    }

    public function viewCommitedCrime($id){
        $this->crime_data = PdlCases::where('pdl_id', $id)->get();

        $this->view_cases = true;

    }
    public function render()
    {
        return view('livewire.admin.commit-list');
    }
}
