<div class="w-64 truncate ml-3 text-sm">
    @if ($getRecord()->pdlcases->count() > 1)
        {{ $getRecord()->pdlcases->first()->crime->name }} and <span
            class="text-green-600 hover:text-blue-700 cursor-pointer">more...</span>
    @endif
</div>
