<div>
    <div>
        {{ $this->form }}
    </div>
    <div class="mt-5">
        <x-button label="SAVE" class="px-2 font-medium" dark wire:click="uploadProfile" spinner="uploadProfile" />
    </div>
</div>
