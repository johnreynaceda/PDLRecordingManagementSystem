<div>

    <div class="flex space-x-4 items-end">
        <img src="{{ asset('storage/' . $pdls->photo_path) }}" wire:ignore class="h-40 w-40 object-cover border"
            alt="">
        <x-button label="View Attachments" slate icon="eye" wire:click="openAttachment" spinner="openAttachment" rounded
            xs />
    </div>
    <div class="mt-8 grid grid-cols-4 gap-5">
        <div>
            <h1 class="font-bold text-xs uppercase">date arrested</h1>
            <h1 class="">
                {{ \Carbon\Carbon::parse($pdls->date_arrested)->format('F d, Y') }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">criminal case no.</h1>
            <h1 class="">
                {{ $pdls->criminal_case_no }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">date of confinement</h1>
            <h1 class="">
                {{ \Carbon\Carbon::parse($pdls->date_of_confinement)->format('F d, Y') }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">court</h1>
            <h1 class="">
                {{ $pdls->court }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">time</h1>
            <h1 class="">
                {{ $pdls->time }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">classification</h1>
            <h1 class="">
                {{ $pdls->classification }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">REMARKS</h1>
            <h1 class="">
                {{ $pdls->remarks ?? 'No remarks' }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">STATUS</h1>
            @switch($pdls->status)
                @case('hearing')
                    <x-badge label="Hearing" positive flat rounded />
                @break

                @case('remand')
                    <x-badge label="Remand" warning flat rounded />
                @break

                @case('release')
                    <x-badge label="Release" negative flat rounded />
                @break

                @default
                    <span>No status</span>
            @endswitch
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">CELL LOCATION</h1>
            <h1 class="">
                {{ $pdls->cell_location ?? 'No location' }}
            </h1>
        </div>

    </div>
    <div class="mt-5">
        <h1 class="font-bold text-xs">COMMITED CRIMES</h1>
        <p class="mt-1">
            @foreach ($crime_data as $data)
                <x-badge label="{{ $data->crime->name }}" />
            @endforeach
        </p>
    </div>
    <div class="mt-10 border-b">
        <h1 class="font-bold text-main">PERSONAL INFORMATION</h1>
    </div>
    <div class="mt-3 grid grid-cols-4 gap-5">

        <div>
            <h1 class="font-bold text-gray-700 text-xs uppercase">Name</h1>
            <h1 class="">
                {{ $pdls->personalInformation->firstname . ' ' . $pdls->personalInformation->middlename . ' ' . $pdls->personalInformation->lastname }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">Date of Birth</h1>
            <h1 class="">
                {{ \Carbon\Carbon::parse($pdls->personalInformation->birthdate)->format('F d, Y') }}
            </h1>
        </div>

        <div>
            <h1 class="font-bold text-xs uppercase">Place of Birth</h1>
            <h1 class="">
                {{ $pdls->personalInformation->birthplace }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">Residence</h1>
            <h1 class="">
                {{ $pdls->personalInformation->residence }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">civil status</h1>
            <h1 class="">
                {{ $pdls->personalInformation->civil_status }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">sex</h1>
            <h1 class="">
                {{ $pdls->personalInformation->sex }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">no. of children</h1>
            <h1 class="">
                {{ $pdls->personalInformation->no_of_children }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">blood type</h1>
            <h1 class="">
                {{ $pdls->personalInformation->blood_type }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">father name</h1>
            <h1 class="">
                {{ $pdls->personalInformation->father_name }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">father birthplace</h1>
            <h1 class="">
                {{ $pdls->personalInformation->father_birthplace }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">father occupation</h1>
            <h1 class="">
                {{ $pdls->personalInformation->father_occupation }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">mother name</h1>
            <h1 class="">
                {{ $pdls->personalInformation->mother_name }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">mother birthplace</h1>
            <h1 class="">
                {{ $pdls->personalInformation->mother_birthplace }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">mother occupation</h1>
            <h1 class="">
                {{ $pdls->personalInformation->mother_occupation }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">Spouse name</h1>
            <h1 class="">
                {{ $pdls->personalInformation->spouse_name }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">spouse occupation</h1>
            <h1 class="">
                {{ $pdls->personalInformation->spouse_occupation }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">first relative</h1>
            <h1 class="">
                {{ $pdls->personalInformation->first_relative }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">relationship</h1>
            <h1 class="">
                {{ $pdls->personalInformation->relationship }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-xs uppercase">Relative Address</h1>
            <h1 class="">
                {{ $pdls->personalInformation->relative_address }}
            </h1>
        </div>
    </div>
    <div class="mt-10 border-b">
        <h1 class="font-bold text-main">PERSONAL DESCRIPTION</h1>
    </div>
    <div class="mt-3 grid grid-cols-4 gap-5">

        <div>
            <h1 class="font-bold text-gray-700 text-xs uppercase">AGE</h1>
            <h1 class="">
                {{ $pdls->personalDescription->age }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-gray-700 text-xs uppercase">height</h1>
            <h1 class="">
                {{ $pdls->personalDescription->height }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-gray-700 text-xs uppercase">weight</h1>
            <h1 class="">
                {{ $pdls->personalDescription->weight }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-gray-700 text-xs uppercase">build</h1>
            <h1 class="">
                {{ $pdls->personalDescription->build }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-gray-700 text-xs uppercase">complexion</h1>
            <h1 class="">
                {{ $pdls->personalDescription->complexion }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-gray-700 text-xs uppercase">hair</h1>
            <h1 class="">
                {{ $pdls->personalDescription->hair }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-gray-700 text-xs uppercase">eyes</h1>
            <h1 class="">
                {{ $pdls->personalDescription->eyes }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-gray-700 text-xs uppercase">religion</h1>
            <h1 class="">
                {{ $pdls->personalDescription->religion }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-gray-700 text-xs uppercase">occupation</h1>
            <h1 class="">
                {{ $pdls->personalDescription->occupation }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-gray-700 text-xs uppercase">attaintment</h1>
            <h1 class="">
                {{ $pdls->personalDescription->attaintment }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-gray-700 text-xs uppercase">nationality</h1>
            <h1 class="">
                {{ $pdls->personalDescription->nationality }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-gray-700 text-xs uppercase">aliases</h1>
            <h1 class="">
                {{ $pdls->personalDescription->aliases }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-gray-700 text-xs uppercase">registered voter</h1>
            <h1 class="">
                {{ $pdls->personalDescription->register_voter }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-gray-700 text-xs uppercase">barangay registration</h1>
            <h1 class="">
                {{ $pdls->personalDescription->brgy_registration }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-gray-700 text-xs uppercase">language</h1>
            <h1 class="">
                {{ $pdls->personalDescription->language }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-gray-700 text-xs uppercase">skills</h1>
            <h1 class="">
                {{ $pdls->personalDescription->skills }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-gray-700 text-xs uppercase">returning date</h1>
            <h1 class="">
                {{ \Carbon\Carbon::parse($pdls->personalDescription->returning_rate)->format('F d, Y') }}
            </h1>
        </div>
        <div>
            <h1 class="font-bold text-gray-700 text-xs uppercase">sentence</h1>
            <h1 class="">
                {{ $pdls->personalDescription->sentence }}
            </h1>
        </div>

    </div>
    <div class="mt-10">
        <h1 class="font-medium">OTHER RELATIVE TO BE CONTACTED/NOTED IN CASE OF EMERGENCY:</h1>
    </div>
    <div class="mt-3 grid grid-cols-4 gap-5">

        @forelse ($contacts as $item)
            <div class="col-span-6 grid grid-cols-4 gap-5">
                <div>
                    <h1 class="font-bold text-gray-700 text-xs uppercase">name</h1>
                    <h1 class="">
                        {{ $item->name }}
                    </h1>
                </div>
                <div>
                    <h1 class="font-bold text-gray-700 text-xs uppercase">relationship</h1>
                    <h1 class="">
                        {{ $item->relationship }}
                    </h1>
                </div>
                <div>
                    <h1 class="font-bold text-gray-700 text-xs uppercase">address</h1>
                    <h1 class="">
                        {{ $item->address }}
                    </h1>
                </div>
                <div>
                    <h1 class="font-bold text-gray-700 text-xs uppercase">contact number</h1>
                    <h1 class="">
                        {{ $item->contact_number }}
                    </h1>
                </div>
            </div>
        @empty
            No Record
        @endforelse
    </div>
    <div class="mt-10 py-5  flex justify-between items-center border-t">
        <div>
            <x-button label="RETURN" href="{{ route('admin.commits') }}" slate icon="arrow-left"
                class="font-medium" />
        </div>
        <div class="flex space-x-2 items-center">
            <x-button label="Print" dark right-icon="printer" class="font-medium" />
            <x-button label="Edit Record" positive right-icon="pencil-alt" class="font-medium"
                wire:click="editRecord" spinner="editRecord" />
        </div>
    </div>


    <x-modal wire:model.defer="edit_modal" blur max-width="7xl">
        <x-card title="EDIT PDL DATA">
            <div>
                <div class=" w-64 ">
                    <img src="{{ Storage::url($pdls->photo_path) }}" alt="">
                    <x-input wire:model="photo_path" label="Photo" type="file" />
                </div>
                <div class="mt-8 grid grid-cols-4 gap-5">
                    <div>
                        <h1 class="font-bold text-xs uppercase">date arrested</h1>
                        <h1 class="mt-1">
                            <x-datetime-picker wire:model="date_arrested" without-time />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">criminal case no.</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="criminal_case" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">date of confinement</h1>
                        <h1 class="mt-1">
                            <x-datetime-picker wire:model="confinement_date" without-time />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">court</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="court" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">time</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="time" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">classification</h1>
                        <x-native-select class="mt-1" wire:model="classification">
                            <option>Select An Option</option>
                            <option>HIGH RISKS</option>
                            <option>HIGH PROFILE</option>
                            <option>HIGH PROFILE/HIGH RISK</option>
                            <option>INSULAR PDL</option>
                            <option>CITY PDL</option>
                            <option>MUNICIPAL PDL</option>
                            <option>ORDINARY</option>
                        </x-native-select>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">REMARKS</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="remarks" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">CELL LOCATION</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="cell_location" />
                        </h1>
                    </div>

                </div>
                <div class="mt-10">
                    <h1 class="font-bold text-xs">COMMITED CRIMES</h1>
                    <p class="mt-1">
                        @foreach ($crime_data as $data)
                            <x-badge label="{{ $data->crime->name }}" />
                        @endforeach
                    </p>

                </div>
                <div class="mt-10 border-b">
                    <h1 class="font-medium">PERSONAL INFORMATION</h1>
                </div>
                <div class="mt-5 grid grid-cols-4 gap-5">

                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">Firstname</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="firstname" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">Middlename</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="middlename" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">Lastname</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="lastname" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">Date of Birth</h1>
                        <h1 class="mt-1">
                            <x-datetime-picker wire:model="birthdate" without-time />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">Place of Birth</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="birthplace" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">Residence</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="residence" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">civil status</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="civil_status" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">sex</h1>
                        <h1 class="mt-1">
                            <x-native-select class="mt-1" wire:model="sex">
                                <option>Select An Option</option>
                                <option>Male</option>
                                <option>Female</option>
                            </x-native-select>
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">no. of children</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="no_of_children" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">blood type</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="blood_type" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">father name</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="father_name" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">father birthplace</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="father_birthplace" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">father occupation</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="father_occupation" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">mother name</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="mother_name" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">mother birthplace</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="mother_birthplace" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">mother occupation</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="mother_occupation" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">Spouse name</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="spouse_name" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">spouse occupation</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="spouse_occupation" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">first relative</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="first_relative" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">relationship</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="relationship" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">Relative Address</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="relative_address" />
                        </h1>
                    </div>
                </div>
                <div class="mt-10 border-b">
                    <h1 class="font-medium">PERSONAL DESCRIPTION</h1>
                </div>
                <div class="mt-5 grid grid-cols-4 gap-5">

                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">Age</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="age" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">height</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="height" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">weight</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="weight" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">build</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="build" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">complexion</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="complexion" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">hair</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="hair" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">eyes</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="eyes" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">religion</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="religion" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">occupation</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="occupation" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">attaintment</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="attaintment" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">nationality</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="nationality" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">aliases</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="aliases" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">registered voter</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="register_voter" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">barangay registration</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="brgy_registration" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">language</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="language" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">skills</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="skills" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">returning date</h1>
                        <h1 class="mt-1">
                            <x-datetime-picker without-time wire:model="returning_date" />
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">sentence</h1>
                        <h1 class="mt-1">
                            <x-input wire:model="sentence" />
                        </h1>
                    </div>

                </div>
                <div class="mt-10">
                    <h1 class="font-medium">OTHER RELATIVE TO BE CONTACTED/NOTIFIED IN CASE OF EMERGENCY:</h1>
                </div>
                <div class="mt-3 mb-10 ">


                    <div>
                        @foreach ($contact_details as $key => $contacts)
                            <div class="col-span-6 grid grid-cols-4 gap-5" wire:key="contact-{{ $key }}">
                                <div>
                                    <h1 class="font-bold text-gray-700 text-xs uppercase">name</h1>
                                    <h1 class="mt-1">
                                        <x-input wire:model="contact_details.{{ $key }}.name" />
                                    </h1>
                                </div>
                                <div>
                                    <h1 class="font-bold text-gray-700 text-xs uppercase">relationship</h1>
                                    <h1 class="mt-1">
                                        <x-input wire:model="contact_details.{{ $key }}.relationship" />
                                    </h1>
                                </div>
                                <div>
                                    <h1 class="font-bold text-gray-700 text-xs uppercase">address</h1>
                                    <h1 class="mt-1">
                                        <x-input wire:model="contact_details.{{ $key }}.address" />
                                    </h1>
                                </div>
                                <div>
                                    <h1 class="font-bold text-gray-700 text-xs uppercase">contact number</h1>
                                    <h1 class="mt-1">
                                        <x-input wire:model="contact_details.{{ $key }}.contact_number" />
                                    </h1>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="">
                    {{ $this->form }}
                </div>
            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat negative label="Cancel" x-on:click="close" />
                    <x-button primary label="Update Record" icon="save" wire:click="updateRecord"
                        spinner="updateRecord" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <x-modal wire:model.defer="attachment_modal" align="center">
        <x-card title="Attachments">
            <div>
                <livewire:pdl-attachment :pdl="$pdl_id" />
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

</div>
