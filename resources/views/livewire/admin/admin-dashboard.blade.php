<div>

    <div class="grid grid-cols-4 mt-3 gap-4 relative">
        @foreach ($crimes as $item)
            <div class=" rounded-[25px] bg-white  p-5 shadow-xl aspect">
                <div class="flex justify-end">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-main" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path
                            d="M5 3V19H21V21H3V3H5ZM19.9393 5.93934L22.0607 8.06066L16 14.1213L13 11.121L9.06066 15.0607L6.93934 12.9393L13 6.87868L16 9.879L19.9393 5.93934Z">
                        </path>
                    </svg>
                </div>
                <div class="my-1">
                    <h2 class="text-3xl fill-main font-bold"><span>
                            {{ \App\Models\Pdl::where('jail_id', auth()->user()->jail_id)->where('crime_id', $item->id)->count() }}
                        </span></h2>
                </div>

                <div>
                    <p class=" font-sans text-base font-medium text-gray-500">{{ $item->name }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-3 text-white">
        {{ $crimes->links('pagination::simple-tailwind') }}
    </div>
</div>
