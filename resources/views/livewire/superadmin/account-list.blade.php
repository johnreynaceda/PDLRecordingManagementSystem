<div>
    {{ $this->table }}
    <x-modal wire:model.defer="add_modal" align="center" max-width="xl">
        <x-card title="Consent Terms">
            <div>
                {{ $this->form }}
            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Create Account" wire:click="saveAccount" spinner="saveAccount" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
