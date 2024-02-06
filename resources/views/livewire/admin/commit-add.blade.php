<div>
    <div>
        {{ $this->form }}
    </div>
    <div class="border-t mt-6  flex space-x-2 p-5">
        <x-button label="Submit Record" right-icon="arrow-right" dark class="font-medium" wire:click="submitRecord"
            spinner="submitRecord" />
        <x-button label="Cancel" href="{{ route('admin.commits') }}" negative flat />
    </div>
</div>
