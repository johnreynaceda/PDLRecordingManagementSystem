<div>
   
    <div class="flex space-x-4 items-end">
        <img src="{{ asset('storage/' . $pdls->photo_path) }}" wire:ignore
            class="h-40 w-40 object-cover border" alt="">
        <x-button label="View Attachments" slate icon="eye" wire:click="openAttachment"
            spinner="openAttachment" rounded xs />
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
                {{ $pdls->personalInformation->firstname . ' ' . $pdls->personalInformation->middlename. ' ' . $pdls->personalInformation->lastname }}
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
                {{ $pdls->personalDescription->returning_rate }}
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
            <x-button label="RETURN" href="{{route('admin.commits')}}" slate icon="arrow-left" class="font-medium"/>
        </div>
        <div class="flex space-x-2 items-center">
            <x-button label="Print" dark right-icon="printer" class="font-medium"/>
            <x-button label="Edit Record" positive right-icon="pencil-alt" class="font-medium"/>
        </div>
    </div>

</div>
