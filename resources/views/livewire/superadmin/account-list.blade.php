<div>
    {{ $this->table }}
    <x-modal wire:model.defer="add_modal" align="center" max-width="xl">
        <x-card title="Consent Terms">
            <div class="grid grid-cols-2 gap-5">
                <x-input label="Name" placeholder="" wire:model="name" />
                <x-input label="Email" type="email" placeholder="" wire:model="email" />
                <x-input label="Password" type="password" wire:model="password" placeholder="" />
                <x-native-select label="User Type" wire:model.live="user_type">
                    <option>Select An Option</option>
                    <option value="admin">Jail Records Unit</option>
                    <option value="records">Regional Monitoring</option>
                    <option value="nhq">National Headquarters</option>
                </x-native-select>
                @if ($user_type == 'admin')
                    <x-native-select label="Jail" wire:model="jail_id">
                        <option>Select An Option</option>
                        @foreach ($jails as $jail)
                            <option value="{{ $jail->id }}">{{ $jail->name }}</option>
                        @endforeach
                    </x-native-select>
                @endif
                @if ($user_type == 'records')
                    <x-native-select label="Region" wire:model="region_id">
                        <option>Select An Option</option>
                        @foreach ($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                        @endforeach
                    </x-native-select>
                @endif
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
