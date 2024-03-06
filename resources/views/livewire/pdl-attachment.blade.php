<div class="z-50">
    <ul class="border-b pb-5 relative">
        @foreach ($attachments as $item)
            <li>
                <a href="{{ Storage::url($item->path) }}" target="_blank"
                    class="hover:text-green-600 flex space-x-1 items-center">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z">
                        </path>
                        <path
                            d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z">
                        </path>
                    </svg>
                    <span>
                        @php
                            $file = explode('/', $item->path);
                        @endphp
                        {{ $file[1] }}
                    </span>
                </a>
            </li>
        @endforeach

    </ul>
    <div class="mt-5">
        <div>
            {{ $this->form }}
        </div>
        <div class="mt-5 relative">
            <x-button label="Submit Attachment" wire:click="submitAttachment" spinner="submitAttachment"
                right-icon="save" positive />
        </div>
    </div>
</div>
