<div class=" ">
    <label class="text-sm font-semibold mb-2 block">Upload Logo</label>
    <input type="file" wire:model.live="logo"
        class="w-full text-black text-sm bg-white border file:cursor-pointer cursor-pointer file:border-0 file:py-2.5 file:px-4 file:bg-gray-100 file:hover:bg-gray-200 file:text-black rounded" />
    <div class="flex items-end space-x-3">
        <p class="text-xs text-gray-600 mt-2">PNG and JPG are Allowed.
        </p>
        <svg xmlns="http://www.w3.org/2000/svg" wire:loading wire:target="logo"
            class="h-4 w-4  text-green-600 animate animate-spin" viewBox="0 0 24 24" fill="currentColor">
            <path
                d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM16.8201 17.0761C18.1628 15.8007 19 13.9981 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19C13.0609 19 14.0666 18.764 14.9676 18.3417L13.9928 16.5871C13.3823 16.8527 12.7083 17 12 17C9.23858 17 7 14.7614 7 12C7 9.23858 9.23858 7 12 7C14.7614 7 17 9.23858 17 12H14L16.8201 17.0761Z">
            </path>
        </svg>
    </div>
</div>
