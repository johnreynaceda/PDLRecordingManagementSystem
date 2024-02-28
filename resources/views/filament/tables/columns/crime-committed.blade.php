@if ($getRecord()->pdlcases->count() > 1)
    {{ $getRecord()->pdlcases->first()->crime->name }} and <span
        class="text-green-600 hover:text-blue-700 ml-3 text-sm cursor-pointer">
        <button wire:click="viewCommitedCrime({{ $getRecord()->id }})"> more..</button>
    </span>
@else
    {{ $getRecord()->pdlcases->first()->crime->name }}
@endif
