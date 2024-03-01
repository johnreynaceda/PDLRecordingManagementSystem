<?php

namespace App\Livewire\Admin;

use App\Models\Crime;
use App\Models\EmergencyContact;
use App\Models\Pdl;
use App\Models\PdlAttachment;
use App\Models\PdlCases;
use App\Models\PersonalDescription;
use App\Models\PersonalInformation;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CommitAdd extends Component implements HasForms
{
    use InteractsWithForms;

    public $date_arrested, $criminal_case_no, $date_of_confinement, $court, $time, $crime_commited = [], $classification, $cell_location, $remarks;

    public $firstname, $lastname, $middlename, $birthdate, $birthplace, $residence, $civil_status, $sex, $no_of_children, $blood_type;

    public $father_name, $father_address, $father_birthplace, $father_occupation;
    public $mother_name, $mother_address, $mother_birthplace, $mother_occupation;

    public $spouse_name, $spouse_occupation, $first_relative, $relationship, $relative_address;

    public $age, $height, $weight, $build, $complexion, $hair, $eyes, $religion, $occupation, $attaintment, $nationality, $aliases, $register_voter, $brgy_registration, $language, $skills, $returning_rate, $sentence;
    public $contacts = [];
    public $photos = [];

    public $attachments = [];

    public function form(Form $form): Form
    {

        return $form
            ->schema([
                Grid::make(3)->schema([
                    FileUpload::make('photos')->imageEditor()->label('Photo')->columnSpan(1)->uploadingMessage('Uploading attachment...'),
                ]),
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
                    TextInput::make('cell_location')->label('Cell Location'),
                    TextInput::make('remarks')->label('Remarks'),
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
              Grid::make(3)->schema([
                FileUpload::make('attachments')->multiple()->acceptedFileTypes(["application/pdf"])
                ->maxSize(49152)->columnSpan(2),
              ])
            ]);
    }

    public function submitRecord()
    {
        sleep(3);
        DB::beginTransaction();
        foreach ($this->photos as $key => $value) {
            $pdl = Pdl::create([
                'jail_id' => auth()->user()->jail_id,
                'date_arrested' => $this->date_arrested,
                'criminal_case_no' => $this->criminal_case_no,
                'date_of_confinement' => $this->date_of_confinement,
                'court' => $this->court,
                'time' => $this->time,
                'classification' => $this->classification,
                'cell_location' => $this->cell_location,
                // 'crime_id' => $this->crime_commited,
                'photo_path' => $value->store('PDL PHOTO', 'public'),
                'remarks' => $this->remarks,
            ]);
        }

       foreach ($this->crime_commited as $key => $value)  {
        PdlCases::create([
            'pdl_id' => $pdl->id,
            'crime_id' =>$value,
        ]);
       }

        PersonalInformation::create([
            'pdl_id' => $pdl->id,
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'lastname' => $this->lastname,
            'birthdate' => $this->birthdate,
            'birthplace' => $this->birthplace,
            'residence' => $this->residence,
            'civil_status' => $this->civil_status,
            'sex' => $this->sex,
            'no_of_children' => $this->no_of_children,
            'blood_type' => $this->blood_type,
            'father_name' => $this->father_name,
            'father_address' => $this->father_address,
            'father_birthplace' => $this->father_birthplace,
            'father_occupation' => $this->father_occupation,
            'mother_name' => $this->mother_name,
            'mother_address' => $this->mother_address,
            'mother_birthplace' => $this->mother_birthplace,
            'mother_occupation' => $this->mother_occupation,
            'spouse_name' => $this->spouse_name,
            'spouse_occupation' => $this->spouse_occupation,
            'first_relative' => $this->first_relative,
            'relationship' => $this->relationship,
            'relative_address' => $this->relative_address,
        ]);
        PersonalDescription::create([
            'pdl_id' => $pdl->id,
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
            'returning_rate' => $this->returning_rate,
            'sentence' => $this->sentence,
        ]);

        foreach ($this->contacts as $key => $value)  {
            EmergencyContact::create([
                'pdl_id' => $pdl->id,
                'name' => $value['contact_name'],
                'relationship' => $value['contact_relationship'],
                'address' => $value['contact_address'],
                'contact_number' => $value['contact_number'],
            ]);
        }

        foreach ($this->attachments as $key => $value) {
            PdlAttachment::create([
                'pdl_id' => $pdl->id,
                'path' => $value->store('PDL Attachments', 'public'),
            ]);
        }

        DB::commit();
        // sweetalert()->addSuccess('PDL is successfully created');
        return redirect()->route('admin.commits');
    }

    public function render()
    {
        return view('livewire.admin.commit-add');
    }
}
