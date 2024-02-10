<?php

namespace App\Livewire\Admin;

use App\Models\Pdl;
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
                TextColumn::make('date_arrested')->date()->label('ARRESTED DATE')->searchable(),
                TextColumn::make('criminal_case_no')->label('CRIMINAL CASE')->searchable(),
                TextColumn::make('court')->label('BRANCH OF COURT')->searchable(),
                TextColumn::make('date_of_confinement')->date()->label('CONFINEMENT DATE')->searchable(),
                // TextColumn::make('crime.name')->label('COMMITTED CRIME')->searchable(),
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
                ViewAction::make('view')->color('warning')->form([
                    Fieldset::make('')->schema([

                        DatePicker::make('date_arrested'),
                        TextInput::make('criminal_case_no'),
                        DatePicker::make('date_of_confinement'),
                        TextInput::make('court'),
                        TextInput::make('time'),
                        Select::make('crime_commited')->searchable()->options([
                            'Abduction with Rape' => 'Abduction with Rape',
                            'Acts of Lasciviousness' => 'Acts of Lasciviousness',
                            'Alarms and Scandal' => 'Alarms and Scandal',
                            'Arson' => 'Arson',
                            'Murder' => 'Murder',
                            'Attempted Estafa' => 'Attempted Estafa',
                            'Attempted Homicide' => 'Attempted Homicide',
                            'Attempted Murder' => 'Attempted Murder',
                            'Attempted Parricide' => 'Attempted Parricide',
                            'Attempted Rape' => 'Attempted Rape',
                            'Attempted Trafficking' => 'Attempted Trafficking',
                            'Carnapping' => 'Carnapping',
                            'Direct Assault' => 'Direct Assault',
                            'Estafa' => 'Estafa',
                            'Evasion of Service of Sentence' => 'Evasion of Service of Sentence',
                            'Frustrated Homicide' => 'Frustrated Homicide',
                            'Frustrated Murder' => 'Frustrated Murder',
                            'Grave Threats' => 'Grave Threats',
                            'Highway Robbery' => 'Highway Robbery',
                            'Homicide' => 'Homicide',
                            'Illegal Possession of Explosives' => 'Illegal Possession of Explosives',
                            'lllegal Possession of Firearm & Ammo' => 'lllegal Possession of Firearm & Ammo',
                            'Illegal Recruitment' => 'Illegal Recruitment',
                            'Illegal Sale and Disposition of Firearms' => 'Illegal Sale and Disposition of Firearms',
                            'Kidnapping and Serious Illegal Detention' => 'Kidnapping and Serious Illegal Detention',
                            'Lascivious Conduct' => 'Lascivious Conduct',
                            'Less Serious Physical Injury' => 'Less Serious Physical Injury',
                            'Malicious Mischief' => 'Malicious Mischief',
                            'Multiple Attempted Murder' => 'Multiple Attempted Murder',
                            'Multiple Frustrated Murder' => 'Multiple Frustrated Murder',
                            'Multiple Murder' => 'Multiple Murder',
                            'Parricide' => 'Parricide',
                            'Rape' => 'Rape',
                            'Qualified Theft' => 'Qualified Theft',
                            'Qualified Trafficking' => 'Qualified Trafficking',
                            'Reckless Imprudence' => 'Reckless Imprudence',
                            'Robbery' => 'Robbery',
                            'RA 9165' => 'RA 9165',
                            'RA 9262' => 'RA 9262',
                            'Serious Illegal Detention' => 'Serious Illegal Detention',
                            'Sexual Assault' => 'Sexual Assault',
                            'Simple Theft' => 'Simple Theft',
                            'Slight Physical Injury' => 'Slight Physical Injury',
                            'Statutory Rape' => 'Statutory Rape',
                            'Syndicated & Large Scale Illegal Recruitment' => 'Syndicated & Large Scale Illegal Recruitment',
                            'Syndicated Estafa' => 'Syndicated Estafa',
                            'Syndicated Illegal Recruitment' => 'Syndicated Illegal Recruitment',
                            'Theft' => 'Theft',
                            'Trespass to Dwelling' => 'Trespass to Dwelling',
                            'Violation of Batas Pambansa No.6' => 'Violation of Batas Pambansa No.6',
                            'PD 133' => 'PD 133',
                            'RA 11479' => 'RA 11479',
                            'PD 1602' => 'PD 1602',
                            'RA 7610' => 'RA 7610',
                            'RA 7832' => 'RA 7832',
                            'BP 881' => 'BP 881',
                            'RA 10591' => 'RA 10591',
                            'Illegal Gambling' => 'Illegal Gambling',
                            'RA 7166' => 'RA 7166',
                            'Trafficking' => 'Trafficking',
                            'Anti Cybercrime Law' => 'Anti Cybercrime Law',
                            'RA 9995' => 'RA 9995',
                        ]),

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
                ]),
                EditAction::make('edit')->color('success'),
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
    public function render()
    {
        return view('livewire.admin.commit-list');
    }
}
