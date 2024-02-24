<div>
    {{ $this->table }}

    <x-modal.card title="PDL DATA FORM" fullscreen blur wire:model.defer="view_modal">
        <div class="mx-auto max-w-7xl">
            @if ($pdl_data)
                <div class="flex space-x-4 items-end">
                    <img src="{{ Storage::url($pdl_data->photo_path) }}" class="h-40 w-40 object-cover border"
                        alt="">
                    <x-button label="View Attachments" slate icon="eye" rounded xs />
                </div>
                <div class="mt-8 grid grid-cols-6 gap-5">
                    <div>
                        <h1 class="font-bold text-xs uppercase">date arrested</h1>
                        <h1 class="">
                            {{ \Carbon\Carbon::parse($pdl_data->date_arrested)->format('F d, Y') }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">criminal case no.</h1>
                        <h1 class="">
                            {{ $pdl_data->criminal_case_no }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">date of confinement</h1>
                        <h1 class="">
                            {{ \Carbon\Carbon::parse($pdl_data->date_of_confinement)->format('F d, Y') }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">court</h1>
                        <h1 class="">
                            {{ $pdl_data->court }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">time</h1>
                        <h1 class="">
                            {{ $pdl_data->time }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">classification</h1>
                        <h1 class="">
                            {{ $pdl_data->classification }}
                        </h1>
                    </div>
                    <div class="col-span-4">
                        <h1 class="font-bold text-xs">COMMITED CRIMES</h1>
                        <p class="mt-1">
                            @foreach ($crime_data as $data)
                                <x-badge label="{{ $data->crime->name }}" />
                            @endforeach
                        </p>
                    </div>
                </div>
                <div class="mt-10 grid grid-cols-6 gap-5">
                    <div class="col-span-6">
                        <h1 class="font-medium">PERSONAL INFORMATION</h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">Name</h1>
                        <h1 class="">
                            {{ $pdl_data->personalInformation->firstname . ' ' . $pdl_data->personalInformation->lastname }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">Date of Birth</h1>
                        <h1 class="">
                            {{ \Carbon\Carbon::parse($pdl_data->personalInformation->birthdate)->format('F d, Y') }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">Place of Birth</h1>
                        <h1 class="">
                            {{ $pdl_data->personalInformation->birthplace }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">Residence</h1>
                        <h1 class="">
                            {{ $pdl_data->personalInformation->residence }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">civil status</h1>
                        <h1 class="">
                            {{ $pdl_data->personalInformation->civil_status }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">sex</h1>
                        <h1 class="">
                            {{ $pdl_data->personalInformation->sex }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">no. of children</h1>
                        <h1 class="">
                            {{ $pdl_data->personalInformation->no_of_children }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">blood type</h1>
                        <h1 class="">
                            {{ $pdl_data->personalInformation->blood_type }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">father name</h1>
                        <h1 class="">
                            {{ $pdl_data->personalInformation->father_name }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">father birthplace</h1>
                        <h1 class="">
                            {{ $pdl_data->personalInformation->father_birthplace }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">father occupation</h1>
                        <h1 class="">
                            {{ $pdl_data->personalInformation->father_occupation }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">mother name</h1>
                        <h1 class="">
                            {{ $pdl_data->personalInformation->mother_name }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">mother birthplace</h1>
                        <h1 class="">
                            {{ $pdl_data->personalInformation->mother_birthplace }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">mother occupation</h1>
                        <h1 class="">
                            {{ $pdl_data->personalInformation->mother_occupation }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">Spouse name</h1>
                        <h1 class="">
                            {{ $pdl_data->personalInformation->spouse_name }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">spouse occupation</h1>
                        <h1 class="">
                            {{ $pdl_data->personalInformation->spouse_occupation }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">first relative</h1>
                        <h1 class="">
                            {{ $pdl_data->personalInformation->first_relative }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">relationship</h1>
                        <h1 class="">
                            {{ $pdl_data->personalInformation->relationship }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-xs uppercase">Relative Address</h1>
                        <h1 class="">
                            {{ $pdl_data->personalInformation->relative_address }}
                        </h1>
                    </div>
                </div>
                <div class="mt-10 grid grid-cols-6 gap-5">
                    <div class="col-span-6">
                        <h1 class="font-medium">PERSONAL DESCRIPTION</h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">AGE</h1>
                        <h1 class="">
                            {{ $pdl_data->personalDescription->age }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">height</h1>
                        <h1 class="">
                            {{ $pdl_data->personalDescription->height }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">weight</h1>
                        <h1 class="">
                            {{ $pdl_data->personalDescription->weight }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">build</h1>
                        <h1 class="">
                            {{ $pdl_data->personalDescription->build }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">complexion</h1>
                        <h1 class="">
                            {{ $pdl_data->personalDescription->complexion }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">hair</h1>
                        <h1 class="">
                            {{ $pdl_data->personalDescription->hair }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">eyes</h1>
                        <h1 class="">
                            {{ $pdl_data->personalDescription->eyes }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">religion</h1>
                        <h1 class="">
                            {{ $pdl_data->personalDescription->religion }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">occupation</h1>
                        <h1 class="">
                            {{ $pdl_data->personalDescription->occupation }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">attaintment</h1>
                        <h1 class="">
                            {{ $pdl_data->personalDescription->attaintment }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">nationality</h1>
                        <h1 class="">
                            {{ $pdl_data->personalDescription->nationality }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">aliases</h1>
                        <h1 class="">
                            {{ $pdl_data->personalDescription->aliases }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">registered voter</h1>
                        <h1 class="">
                            {{ $pdl_data->personalDescription->register_voter }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">barangay registration</h1>
                        <h1 class="">
                            {{ $pdl_data->personalDescription->brgy_registration }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">language</h1>
                        <h1 class="">
                            {{ $pdl_data->personalDescription->language }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">skills</h1>
                        <h1 class="">
                            {{ $pdl_data->personalDescription->skills }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">returning date</h1>
                        <h1 class="">
                            {{ $pdl_data->personalDescription->returning_date }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-700 text-xs uppercase">sentence</h1>
                        <h1 class="">
                            {{ $pdl_data->personalDescription->sentence }}
                        </h1>
                    </div>

                </div>
                <div class="mt-10 grid grid-cols-6 gap-5">
                    <div class="col-span-6">
                        <h1 class="font-medium">OTHER RELATIVE TO BE CONTACTED/NOTED IN CASE OF EMERGENCY:</h1>
                    </div>
                    @forelse ($contacts as $item)
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
                    @empty
                        sdsds
                    @endforelse
                </div>
            @endif
        </div>

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button dark label="Print" icon="printer" />
                <x-button positive label="Edit Record" icon="pencil-alt" />
                <div class="flex">
                    <x-button outline label="Cancel" x-on:click="close" />

                </div>
            </div>
        </x-slot>
    </x-modal.card>

    <x-modal wire:model.defer="view_cases" align="center">
        <x-card title="Committed Crimes">
            <div>
                <ul>
                    @foreach ($crime_data as $item)
                        <li>{{ $item->crime->name }}</li>
                    @endforeach
                </ul>
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
