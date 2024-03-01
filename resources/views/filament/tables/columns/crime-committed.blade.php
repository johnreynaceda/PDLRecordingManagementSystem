@if ($getRecord()->pdlcases->count() > 1)
    <div class="text-xs ml-3">
        {{ $getRecord()->pdlcases->first()->crime->name }} and <span
            class="text-green-600 hover:text-blue-700  text-sm cursor-pointer">
            <button wire:click="viewCommitedCrime({{ $getRecord()->id }})"> <span>more..</span></button>
        </span>
    </div>
@else
    <span class="text-xs ml-3"> {{ $getRecord()->pdlcases->first()->crime->name }}</span>
@endif
