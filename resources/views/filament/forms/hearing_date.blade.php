<div>
    <ul class="space-y-1">
        @forelse ($getRecord()->pdlHearings as $item)
            <li class="p-2 border flex justify-between items-center rounded-lg">
                <div>
                    <div class="flex space-x-2">
                        <svg class="w-6 h-6 text-main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path
                                d="M5.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H6a.75.75 0 01-.75-.75V12zM6 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H6zM7.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H8a.75.75 0 01-.75-.75V12zM8 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H8zM9.25 10a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V10zM10 11.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V12a.75.75 0 00-.75-.75H10zM9.25 14a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V14zM12 9.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V10a.75.75 0 00-.75-.75H12zM11.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H12a.75.75 0 01-.75-.75V12zM12 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H12zM13.25 10a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H14a.75.75 0 01-.75-.75V10zM14 11.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V12a.75.75 0 00-.75-.75H14z">
                            </path>
                            <path fill-rule="evenodd"
                                d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <h1>{{ \Carbon\Carbon::parse($item->date_of_hearing)->format('F d, Y') }}</h1>
                            <h1 class="text-sm">Time:
                                {{ \Carbon\Carbon::parse($item->time_of_hearing)->format('h:i A') }}
                            </h1>
                        </div>
                    </div>

                </div>
                <div class="text-sm flex space-x-2 items-center">
                    <x-button.circle icon="pencil-alt" wire:click="editHearing({{ $item->id }})"
                        spinner="editHearing({{ $item->id }})" positive sm />
                    <x-button.circle icon="trash" wire:click="deleteHearing({{ $item->id }})"
                        spinner="deleteHearing({{ $item->id }})" negative sm />
                </div>
            </li>
        @empty
            <h1>No Hearing Dates Record...</h1>
        @endforelse



    </ul>
    @if ($this->edit_hearings)
        <div class="mt-5 border rounded-lg p-3 ">
            <div class="grid grid-cols-2 gap-3" wire:ignore>
                <x-datetime-picker label="Date" placeholder="" without-timezone without-time wire:model="date" />
                <x-time-picker label="Time" placeholder="" wire:model="time" />

            </div>
            <div class="mt-3">
                <x-button label="Update Record" wire:click="updateHearing" spinner="updateHearing" xs positive />
            </div>
        </div>
    @endif
</div>
