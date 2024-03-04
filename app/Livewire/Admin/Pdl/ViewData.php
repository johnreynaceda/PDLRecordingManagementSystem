<?php

namespace App\Livewire\Admin\Pdl;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use App\Models\EmergencyContact;
use App\Models\Pdl;
use App\Models\PdlCases;
use Carbon\Carbon;
use Livewire\Component;
use WireUi\Traits\Actions;
class ViewData extends Component implements HasForms
{
  use InteractsWithForms;
    use Actions;


    public $attachment_modal = false;
    public $pdl_id;
    public $edit_modal = false;

    public $date_arrested, $criminal_case,$confinement_date, $court, $time, $classification, $remarks, $photo_path, $cell_location;
    //personal info
    public $firstname, $middlename, $lastname,$birthdate, $birthplace, $residence, $civil_status, $sex, $no_of_children, $blood_type, $father_name, $father_birthplace, $father_occupation, $mother_name, $mother_occupation, $mother_birthplace, $spouse_name, $spouse_occupation, $first_relative,$relationship, $relative_address;

    //description
    public $age, $height, $weight, $build, $complexion, $hair, $eyes, $religion, $occupation, $attaintment, $nationality, $aliases, $register_voter, $brgy_registration, $language, $skills, $returning_date, $sentence;

    public $emergency_contacts;
    public $contact_details = [];
    public $contact_detailss = [];

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('emergency_contacts')->label('')->schema([
                    TextInput::make('contact_name'),
                    TextInput::make('contact_relationship'),
                    TextInput::make('contact_address'),
                    TextInput::make('contact_number'),
                ])->columns(2)->columnSpan(2)->addActionLabel('Add additional information')->defaultItems(1),
            ]);
    }

    public function mount(){
        $this->pdl_id = request('id');
    }

    public function openAttachment(){
        sleep(2);
        $this->dispatch('attachment', pdl_id: $this->pdl_id);
        $this->attachment_modal = true;
    }

    public function editRecord(){
        sleep(1);
        $pdl_data = Pdl::where('id', $this->pdl_id)->first();
        $this->date_arrested = $pdl_data->date_arrested;
               $this->criminal_case = $pdl_data->criminal_case_no;
               $this->confinement_date = $pdl_data->date_of_confinement;
               $this->court = $pdl_data->court;
               $this->time = $pdl_data->time;
               $this->classification = $pdl_data->classification;
               $this->remarks = $pdl_data->remarks;
               $this->cell_location = $pdl_data->cell_location;

               $this->firstname = $pdl_data->personalInformation->firstname;
               $this->middlename = $pdl_data->personalInformation->middlename;
               $this->lastname = $pdl_data->personalInformation->lastname;
               $this->birthdate = $pdl_data->personalInformation->birthdate;
               $this->birthplace = $pdl_data->personalInformation->birthplace;
               $this->residence = $pdl_data->personalInformation->residence;
               $this->civil_status = $pdl_data->personalInformation->civil_status;
               $this->sex = $pdl_data->personalInformation->sex;
               $this->no_of_children = $pdl_data->personalInformation->no_of_children;
               $this->blood_type = $pdl_data->personalInformation->blood_type;
               $this->father_name = $pdl_data->personalInformation->father_name;
               $this->father_birthplace = $pdl_data->personalInformation->father_birthplace;
               $this->father_occupation = $pdl_data->personalInformation->father_occupation;
               $this->mother_name = $pdl_data->personalInformation->mother_name;
               $this->mother_occupation = $pdl_data->personalInformation->mother_occupation;
               $this->mother_birthplace = $pdl_data->personalInformation->mother_birthplace;
               $this->spouse_name = $pdl_data->personalInformation->spouse_name;
               $this->spouse_occupation = $pdl_data->personalInformation->spouse_occupation;
               $this->first_relative = $pdl_data->personalInformation->first_relative;
               $this->relationship = $pdl_data->personalInformation->relationship;
               $this->relative_address = $pdl_data->personalInformation->relative_address;

               $this->age = $pdl_data->PersonalDescription->age;
               $this->height = $pdl_data->PersonalDescription->height;
               $this->weight = $pdl_data->PersonalDescription->weight;
               $this->build = $pdl_data->PersonalDescription->build;
               $this->complexion = $pdl_data->PersonalDescription->complexion;
               $this->hair = $pdl_data->PersonalDescription->hair;
               $this->eyes = $pdl_data->PersonalDescription->eyes;
               $this->religion = $pdl_data->PersonalDescription->religion;
               $this->occupation = $pdl_data->PersonalDescription->occupation;
               $this->attaintment = $pdl_data->PersonalDescription->attaintment;
               $this->nationality = $pdl_data->PersonalDescription->nationality;
               $this->aliases = $pdl_data->PersonalDescription->aliases;
               $this->register_voter = $pdl_data->PersonalDescription->register_voter;
               $this->brgy_registration = $pdl_data->PersonalDescription->brgy_registration;
               $this->language = $pdl_data->PersonalDescription->language;
               $this->skills = $pdl_data->PersonalDescription->skills;
               $this->returning_date = $pdl_data->PersonalDescription->returning_rate;
               $this->sentence = $pdl_data->PersonalDescription->sentence;

               $this->contact_details = $pdl_data->EmergencyContacts->toArray();
        $this->edit_modal = true;
    }

    public function updateRecord(){
        sleep(1);
        $pdl_data = Pdl::where('id', $this->pdl_id)->first();

        $pdl_data->update([
            'date_arrested' => Carbon::parse($this->date_arrested),
            'criminal_case_no' => $this->criminal_case,
            'date_of_confinement' => Carbon::parse($this->confinement_date),
            'court' => $this->court,
            'time' => $this->time,
            'photo_path' => $this->photo_path != null ? $this->photo_path->store('PDL PHOTO', 'public') : $pdl_data->photo_path,
            'classification' => $this->classification,
            'remarks' => $this->remarks,
            'cell_location' => $this->cell_location,
          ]);

          $pdl_data->personalInformation->update([
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

          $pdl_data->personalDescription->update([
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

             if ($this->emergency_contacts) {
                foreach ($this->emergency_contacts as $key => $value)  {
                    EmergencyContact::create([
                        'pdl_id' => $this->pdl_id,
                        'name' => $value['contact_name'],
                        'relationship' => $value['contact_relationship'],
                        'address' => $value['contact_address'],
                        'contact_number' => $value['contact_number'],
                    ]);
                }
             }

          $this->dialog()->success(
            $title = 'PDL updated',
            $description = 'PDL information has been updated.'
          );

          $this->edit_modal = false;
    }

    public function render()
    {

        return view('livewire.admin.pdl.view-data',[
            'pdls' => Pdl::where('id', $this->pdl_id)->first(),
            'crime_data' => PdlCases::where('pdl_id', $this->pdl_id)->get(),
            'contacts' => EmergencyContact::where('pdl_id', $this->pdl_id)->get(),
        ]);
    }
}
