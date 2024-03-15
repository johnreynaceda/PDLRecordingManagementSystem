<?php

namespace App\Livewire\Admin;

use App\Filament\Exports\PdlExporter;
use App\Models\Crime;
use App\Models\EmergencyContact;
use App\Models\Jail;
use App\Models\LogHistory;
use App\Models\Pdl;
use App\Models\PdlCases;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
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
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use WireUi\Traits\Actions;
use Filament\Forms\Components\ViewField;
use Filament\Tables\Columns\ViewColumn;
use pxlrbt\FilamentExcel\Columns\Column;
// use App\Filament\Exports\ProductExporter;
use Filament\Tables\Actions\ExportAction;
use App\Filament\Exports\ProductExporter;
use Filament\Tables\Actions\ExportBulkAction;

class CommitList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    use Actions;
    public $pdl_data;
    public $view_cases = false;
    public $view_modal = false;

    public $edit_data = false;

    public $crime_data = [];
    public $contacts = [];

    public $attachment_modal = false;
    public $pdl_id;

    //pdl
    public $date_arrested, $criminal_case,$confinement_date, $court, $time, $classification, $remarks, $photo_path, $cell_location;
    //personal info
    public $firstname, $middlename, $lastname,$birthdate, $birthplace, $residence, $civil_status, $sex, $no_of_children, $blood_type, $father_name, $father_birthplace, $father_occupation, $mother_name, $mother_occupation, $mother_birthplace, $spouse_name, $spouse_occupation, $first_relative,$relationship, $relative_address;

    //description
    public $age, $height, $weight, $build, $complexion, $hair, $eyes, $religion, $occupation, $attaintment, $nationality, $aliases, $register_voter, $brgy_registration, $language, $skills, $returning_date, $sentence;

    public $contact_details;
    public $contact_detailss = [];
    // public function updatedEditData(){
    //     if ($this->edit_data) {
    //         // $this->photo_path = $this->pdl_data->photo_path;
    //        $this->date_arrested = $this->pdl_data->date_arrested;
    //        $this->criminal_case = $this->pdl_data->criminal_case_no;
    //        $this->confinement_date = $this->pdl_data->date_of_confinement;
    //        $this->court = $this->pdl_data->court;
    //        $this->time = $this->pdl_data->time;
    //        $this->classification = $this->pdl_data->classification;
    //        $this->remarks = $this->pdl_data->remarks;
    //        $this->cell_location = $this->pdl_data->cell_location;

    //        $this->firstname = $this->pdl_data->personalInformation->firstname;
    //        $this->middlename = $this->pdl_data->personalInformation->middlename;
    //        $this->lastname = $this->pdl_data->personalInformation->lastname;
    //        $this->birthdate = $this->pdl_data->personalInformation->birthdate;
    //        $this->birthplace = $this->pdl_data->personalInformation->birthplace;
    //        $this->residence = $this->pdl_data->personalInformation->residence;
    //        $this->civil_status = $this->pdl_data->personalInformation->civil_status;
    //        $this->sex = $this->pdl_data->personalInformation->sex;
    //        $this->no_of_children = $this->pdl_data->personalInformation->no_of_children;
    //        $this->blood_type = $this->pdl_data->personalInformation->blood_type;
    //        $this->father_name = $this->pdl_data->personalInformation->father_name;
    //        $this->father_birthplace = $this->pdl_data->personalInformation->father_birthplace;
    //        $this->father_occupation = $this->pdl_data->personalInformation->father_occupation;
    //        $this->mother_name = $this->pdl_data->personalInformation->mother_name;
    //        $this->mother_occupation = $this->pdl_data->personalInformation->mother_occupation;
    //        $this->mother_birthplace = $this->pdl_data->personalInformation->mother_birthplace;
    //        $this->spouse_name = $this->pdl_data->personalInformation->spouse_name;
    //        $this->spouse_occupation = $this->pdl_data->personalInformation->spouse_occupation;
    //        $this->first_relative = $this->pdl_data->personalInformation->first_relative;
    //        $this->relationship = $this->pdl_data->personalInformation->relationship;
    //        $this->relative_address = $this->pdl_data->personalInformation->relative_address;

    //        $this->age = $this->pdl_data->PersonalDescription->age;
    //        $this->height = $this->pdl_data->PersonalDescription->height;
    //        $this->weight = $this->pdl_data->PersonalDescription->weight;
    //        $this->build = $this->pdl_data->PersonalDescription->build;
    //        $this->complexion = $this->pdl_data->PersonalDescription->complexion;
    //        $this->hair = $this->pdl_data->PersonalDescription->hair;
    //        $this->eyes = $this->pdl_data->PersonalDescription->eyes;
    //        $this->religion = $this->pdl_data->PersonalDescription->religion;
    //        $this->occupation = $this->pdl_data->PersonalDescription->occupation;
    //        $this->attaintment = $this->pdl_data->PersonalDescription->attaintment;
    //        $this->nationality = $this->pdl_data->PersonalDescription->nationality;
    //        $this->aliases = $this->pdl_data->PersonalDescription->aliases;
    //        $this->register_voter = $this->pdl_data->PersonalDescription->register_voter;
    //        $this->brgy_registration = $this->pdl_data->PersonalDescription->brgy_registration;
    //        $this->language = $this->pdl_data->PersonalDescription->language;
    //        $this->skills = $this->pdl_data->PersonalDescription->skills;
    //        $this->returning_date = $this->pdl_data->PersonalDescription->returning_rate;
    //        $this->sentence = $this->pdl_data->PersonalDescription->sentence;

    //        $this->contact_details = $this->pdl_data->EmergencyContacts->toArray();
    //         $this->view_modal = false;


    //     }
    // }



    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('cases')->options(Crime::pluck('name', 'id'))->multiple()->required()->default(PdlCases::where('pdl_id', ($this->pdl_data->id ?? 2))->pluck('crime_id')->toArray())
            ])
           ;
    }

    public function openAttachment(){
        sleep(2);
        $this->dispatch('attachment', pdl_id: $this->pdl_id);
        $this->attachment_modal = true;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(auth()->user()->user_type == 'superadmin' ? Pdl::query() : Pdl::query()->where('jail_id', auth()->user()->jail_id))->headerActions([
               Action::make('new_record')->icon('heroicon-o-plus')->icon('heroicon-o-plus')->color('success')->action(
                function(){
                    return redirect()->route('admin.commits.add');
                }
               )->hidden(auth()->user()->user_type == 'superadmin'),
            ])
            ->columns([
                TextColumn::make('id')->label('FULLNAME')->formatStateUsing(
                    function ($record) {
                        return $record->personalInformation->lastname. ', '. $record->personalInformation->firstname. ' '. $record->personalInformation->middlename;
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
                TextColumn::make('jail.region.name')->label('REGION')->searchable()->visible(auth()->user()->user_type == 'superadmin'),
                ])
            ->filters([
    //             Filter::make('created_at')->indicator('Administrators')
    //             ->form([
    //                 DatePicker::make('created_from'),
    //             ])
    //             ->query(function (Builder $query, array $data): Builder {
    //                 return $query
    //                     ->when(
    //                         $data['created_from'],
    //                         fn (Builder $query, $date): Builder => $query->whereDate('created_at', $date),
    //                     );

    //             }),
    //             SelectFilter::make('jail')
    // ->options(Jail::pluck('name', 'id'))
            ])
            ->actions([
                Action::make('edit_cases')->icon('heroicon-c-paper-clip')->color('success')->action(
                    function($record, $data){

                        PdlCases::where('pdl_id', $record->id)->delete();

                        foreach ($data['cases'] as $key => $value) {
                            PdlCases::create([
                                'pdl_id' => $record->id,
                                'crime_id' => $value,
                            ]);
                        }
                        LogHistory::create([
                           'pdl_id' => $record->id,
                           'user_id' => auth()->user()->id,
                           'description' => 'Update Cases',
                           'type' => 'Update',
                        ]);
                    }
                )->form(
                    function($record){
                        return [
                            Select::make('cases')->searchable()->options(Crime::pluck('name', 'id'))->multiple()->required()->default(PdlCases::where('pdl_id', ($record->id))->pluck('crime_id')->toArray())
                        ];
                    }
                ),
                Action::make('view_data')->icon('heroicon-s-folder-open')->color('warning')->url(
                    function($record){
                        // $this->pdl_data = $record;
                        // $this->pdl_id = $record->id;
                        // $this->crime_data = PdlCases::where('pdl_id', $record->id)->get();
                        // $this->contacts = EmergencyContact::where('pdl_id', $record->id)->get();
                        // $this->view_modal = true;

                        return route('admin.commits.view', ['id' => $record->id]);
                    }
                ),

                ActionGroup::make([
                    Action::make('hearings')->icon('heroicon-s-cursor-arrow-ripple')->color('info')->action(
                        function($record, $data){
                            $record->update([
                                'status' => 'hearing',
                            ]);
                            LogHistory::create([
                                'pdl_id' => $record->id,
                                'user_id' => auth()->user()->id,
                                'description' => 'Update Hearings',
                                'type' => 'Update',
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
                            LogHistory::create([
                                'pdl_id' => $record->id,
                                'user_id' => auth()->user()->id,
                                'description' => 'Update Remand',
                                'type' => 'Update',
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
                            LogHistory::create([
                                'pdl_id' => $record->id,
                                'user_id' => auth()->user()->id,
                                'description' => 'Update Release',
                                'type' => 'Update',
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

            ])->emptyStateDescription('Once you add PDL Record, it will appear here.')->emptyStateIcon('heroicon-o-document-text');
    }

    public function editRecord(){
        $this->edit_data = true;
    }

    public function updateRecords(){
        dd('dsds');
      $this->pdl_data->update([
        'date_arrested' => Carbon::parse($this->date_arrested),
        'criminal_case_no' => $this->criminal_case,
        'date_of_confinement' => Carbon::parse($this->confinement_date),
        'court' => $this->court,
        'time' => $this->time,
        'photo_path' => $this->photo_path != null ? $this->photo_path->store('PDL PHOTO', 'public') : $this->pdl_data->photo_path,
        'classification' => $this->classification,
        'remarks' => $this->remarks,
        'cell_location' => $this->cell_location,
      ]);

      $this->pdl_data->personalInformation->update([
        'firstname' => $this->firstname,
        'lastname' => $this->lastname,
        'birthdate' => Carbon::parse($this->birthdate),
        'birthplace' => $this->birthplace,
        'residence' => $this->residence,
        'civil_status' => $this->civil_status,
        'sex' => $this->sex,
        'no_of_children' => $this->no_of_children,
        'blood_type' => $this->blood_type,
        'father_name' => $this->father_name,
        'father_occupation' => $this->father_occupation,
        'father_birthplace' => $this->father_birthplace,
        'mother_name' => $this->mother_name,
        'mother_occupation' => $this->mother_occupation,
        'mother_birthplace' => $this->mother_birthplace,
        'spouse_name' => $this->spouse_name,
        'spouse_occupation' => $this->spouse_occupation,
        'first_relative' => $this->first_relative,
        'relationship' => $this->relationship,
        'relative_address' => $this->relative_address,
      ]);

      $this->pdl_data->personalDescription->update([
        'age' => $this->age,
        'height' => $this->height,
        'weight' => $this->weight,
        'build' => $this->build,
        'complexion' => $this->complexion,
        'hair' => $this->hair,
        'eyes' => $this->eyes,
      'religion' => $this->religion,
      'occupation' => $this->occupation,
      'attaintment' => $this->attaintment,
      'nationality' => $this->nationality,
      'aliases' => $this->aliases,
    'register_voter' => $this->register_voter,
    'brgy_registration' => $this->brgy_registration,
    'language' => $this->language,
 'skills' => $this->skills,

'returning_rate' => Carbon::parse($this->returning_date),
'sentence' => $this->sentence,
      ]);

      foreach($this->contact_details as $contact){
        EmergencyContact::where('id', $contact['id'])->first()->update([
           'name' => $contact['name'],
           'relationship' => $contact['relationship'],
           'address' => $contact['address'],
           'contact_number' => $contact['contact_number'],
        ]);
         }
         $this->updatedEditData();
      $this->dialog()->success(
        $title = 'PDL updated',
        $description = 'PDL information has been updated.'
      );

      $this->edit_data = false;
    }

    public function viewCommitedCrime($id){
        $this->crime_data = PdlCases::where('pdl_id', $id)->get();

        $this->view_cases = true;

    }

    public function updates(){
        dd('sdsd');
    }
    public function render()
    {
        return view('livewire.admin.commit-list');
    }
}
