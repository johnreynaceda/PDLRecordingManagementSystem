<div>
    {{ $this->table }}

    <x-modal wire:model.defer="open_modal" align="center">
        <x-card title="Issuances">
            <div>
                <div>
                    <x-input label="Attachment" type="file" multiple wire:model="attachment" hint="PDF file only." />
                    <span wire:loading wire:target="attachment" class="text-sm">loading....</span>
                </div>

            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button dark label="Save Record" wire:click="submitRecord" spinner="submitRecord" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
