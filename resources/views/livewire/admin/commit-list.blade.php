<div>
    {{ $this->table }}

    <x-modal.card title="PDL DATA FORM" fullscreen blur wire:model.defer="view_modal">
        <div class="mx-auto max-w-7xl">
            @if ($pdl_data)
                <img src="{{ Storage::url($pdl_data->photo_path) }}" class="h-40 w-40 object-cover border" alt="">
                <div class="mt-5 grid grid-cols-6 gap-5">
                    <div>
                        <h1 class="font-medium text-sm">Name</h1>
                        <h1 class="">
                            {{ $pdl_data->personalInformation->firstname . ' ' . $pdl_data->personalInformation->lastname }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-medium text-sm">Date of Birth</h1>
                        <h1 class="">
                            {{ \Carbon\Carbon::parse($pdl_data->personalInformation->birthdate)->format('F d, Y') }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="font-medium text-sm">Place of Birth</h1>
                        <h1 class="">
                            {{ $pdl_data->personalInformation->birthplace }}
                        </h1>
                    </div>
                </div>
            @endif
        </div>

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">


                <div class="flex">
                    <x-button dark label="Cancel" x-on:click="close" />

                </div>
            </div>
        </x-slot>
    </x-modal.card>
</div>
