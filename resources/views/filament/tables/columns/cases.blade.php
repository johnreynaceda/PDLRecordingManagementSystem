<div class="w-64 truncate block ml-3 text-xs">
    @if ($getRecord()->pdlcases->count() > 1)
        {{ $getRecord()->pdlcases->first()->crime->name }} and <span
            class="text-green-600 hover:text-blue-700 cursor-pointer">
            <button wire:click="viewCommitedCrime({{ $getRecord()->id }})">more..</button>
        </span>
    @endif
</div>
