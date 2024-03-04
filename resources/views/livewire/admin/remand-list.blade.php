<div>
    {{ $this->table }}

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
