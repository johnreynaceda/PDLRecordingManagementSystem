<div>

    <div class="border-b pb-10">
        <div>
            <div class="mb-3  flex space-x-4 w-5/12">
                <x-datetime-picker placeholder="{{ now()->format('m/d/Y') }}" without-time wire:model.live="date_from" />
                <x-datetime-picker placeholder="{{ now()->format('m/d/Y') }}" without-time wire:model.live="date_to" />
            </div>
            <div class="grid grid-cols-4 mt-51 gap-4 relative">
                <div class=" rounded-[25px] bg-white  p-5 shadow-xl aspect">
                    <div class="flex justify-end">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-main" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M12 0.5C18.3513 0.5 23.5 5.64873 23.5 12C23.5 12.3369 23.4855 12.6704 23.4571 13H21.9506C21.4489 18.0533 17.1853 22 12 22C6.47715 22 2 17.5228 2 12C2 6.81465 5.94668 2.5511 11 2.04938V0.542876C11.3296 0.514488 11.6631 0.5 12 0.5ZM11 4.06189C7.05369 4.55399 4 7.92038 4 12C4 16.4183 7.58172 20 12 20C16.0796 20 19.446 16.9463 19.9381 13H11V4.06189ZM13 2.552V11H21.448C20.9827 6.55197 17.448 3.01732 13 2.552Z">
                            </path>
                        </svg>
                    </div>
                    <div class="my-1">
                        <h2 class="text-3xl fill-main font-bold"><span>
                                {{ $commits }}
                            </span></h2>
                    </div>

                    <div class="flex justify-between items-center">
                        <p class=" font-sans text-base font-medium text-gray-500">Total Commits</p>
                        <x-badge
                            label="{{ \App\Models\Pdl::whereDate('date_of_confinement', now())->where('jail_id', auth()->user()->jail_id)->count() }}"
                            dark />
                    </div>
                </div>
                <div class=" rounded-[25px] bg-white  p-5 shadow-xl aspect">
                    <div class="flex justify-end">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-main" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M12 0.5C18.3513 0.5 23.5 5.64873 23.5 12C23.5 12.3369 23.4855 12.6704 23.4571 13H21.9506C21.4489 18.0533 17.1853 22 12 22C6.47715 22 2 17.5228 2 12C2 6.81465 5.94668 2.5511 11 2.04938V0.542876C11.3296 0.514488 11.6631 0.5 12 0.5ZM11 4.06189C7.05369 4.55399 4 7.92038 4 12C4 16.4183 7.58172 20 12 20C16.0796 20 19.446 16.9463 19.9381 13H11V4.06189ZM13 2.552V11H21.448C20.9827 6.55197 17.448 3.01732 13 2.552Z">
                            </path>
                        </svg>
                    </div>
                    <div class="my-1">
                        <h2 class="text-3xl fill-main font-bold"><span>
                                {{ $remands }}
                            </span></h2>
                    </div>

                    <div class="flex justify-between items-center">
                        <p class=" font-sans text-base font-medium text-gray-500">Total Remands</p>
                        <x-badge
                            label="{{ \App\Models\Pdl::whereDate('date_of_remand', now())->where('jail_id', auth()->user()->jail_id)->count() }}"
                            dark />
                    </div>
                </div>
                <div class=" rounded-[25px] bg-white  p-5 shadow-xl aspect">
                    <div class="flex justify-end">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-main" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M12 0.5C18.3513 0.5 23.5 5.64873 23.5 12C23.5 12.3369 23.4855 12.6704 23.4571 13H21.9506C21.4489 18.0533 17.1853 22 12 22C6.47715 22 2 17.5228 2 12C2 6.81465 5.94668 2.5511 11 2.04938V0.542876C11.3296 0.514488 11.6631 0.5 12 0.5ZM11 4.06189C7.05369 4.55399 4 7.92038 4 12C4 16.4183 7.58172 20 12 20C16.0796 20 19.446 16.9463 19.9381 13H11V4.06189ZM13 2.552V11H21.448C20.9827 6.55197 17.448 3.01732 13 2.552Z">
                            </path>
                        </svg>
                    </div>
                    <div class="my-1">
                        <h2 class="text-3xl fill-main font-bold"><span>
                                {{ $releases < 0 ? 0 : $releases }}
                            </span></h2>
                    </div>

                    <div class="flex justify-between items-center">
                        <p class=" font-sans text-base font-medium text-gray-500">Total Release</p>
                        <x-badge
                            label="{{ \App\Models\Pdl::whereDate('date_of_release', now())->where('jail_id', auth()->user()->jail_id)->count() }}"
                            dark />
                    </div>
                </div>
                <div class=" rounded-[25px] bg-white  p-5 shadow-xl aspect">
                    <div class="flex justify-end">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-main" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M12 0.5C18.3513 0.5 23.5 5.64873 23.5 12C23.5 12.3369 23.4855 12.6704 23.4571 13H21.9506C21.4489 18.0533 17.1853 22 12 22C6.47715 22 2 17.5228 2 12C2 6.81465 5.94668 2.5511 11 2.04938V0.542876C11.3296 0.514488 11.6631 0.5 12 0.5ZM11 4.06189C7.05369 4.55399 4 7.92038 4 12C4 16.4183 7.58172 20 12 20C16.0796 20 19.446 16.9463 19.9381 13H11V4.06189ZM13 2.552V11H21.448C20.9827 6.55197 17.448 3.01732 13 2.552Z">
                            </path>
                        </svg>
                    </div>
                    <div class="my-1">
                        <h2 class="text-3xl fill-main font-bold"><span>
                                {{ $jails < 0 ? 0 : $jails }}
                            </span></h2>
                    </div>

                    <div class="flex justify-between items-center">
                        <p class=" font-sans text-base font-medium text-gray-500">Total Jail Population</p>
                        <x-badge
                            label="{{ \App\Models\Pdl::where('jail_id', auth()->user()->jail_id)->count() -(\App\Models\Pdl::where('status', 'remand')->where('jail_id', auth()->user()->jail_id)->count() +\App\Models\Pdl::where('status', 'release')->where('jail_id', auth()->user()->jail_id)->count()) }}"
                            dark />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="border-b py-10">
        <div>
            {{-- <div class="mb-3 w-96">
                <x-datetime-picker placeholder="{{ now()->format('m/d/Y') }}" without-time wire:model.live="date" />
            </div> --}}
            <div class="grid grid-cols-4 mt-3 gap-4 relative">
                @php
                    $classifications = [['name' => 'HIGH RISKS'], ['name' => 'HIGH PROFILE'], ['name' => 'HIGH PROFILE/HIGH RISK'], ['name' => 'INSULAR PDL'], ['name' => 'CITY PDL'], ['name' => 'MUNICIPAL PDL'], ['name' => 'ORDINARY']];
                @endphp
                @foreach ($classifications as $item)
                    <div class=" rounded-[25px] bg-white  p-5 shadow-xl aspect">
                        <div class="flex justify-end">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-main" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M12 0.5C18.3513 0.5 23.5 5.64873 23.5 12C23.5 12.3369 23.4855 12.6704 23.4571 13H21.9506C21.4489 18.0533 17.1853 22 12 22C6.47715 22 2 17.5228 2 12C2 6.81465 5.94668 2.5511 11 2.04938V0.542876C11.3296 0.514488 11.6631 0.5 12 0.5ZM11 4.06189C7.05369 4.55399 4 7.92038 4 12C4 16.4183 7.58172 20 12 20C16.0796 20 19.446 16.9463 19.9381 13H11V4.06189ZM13 2.552V11H21.448C20.9827 6.55197 17.448 3.01732 13 2.552Z">
                                </path>
                            </svg>
                        </div>
                        <div class="my-1">
                            <h2 class="text-3xl fill-main font-bold"><span>
                                    @php
                                        $total =
                                            \App\Models\Pdl::where('classification', $item['name'])
                                                ->where('jail_id', auth()->user()->jail_id)
                                                ->count() -
                                            (\App\Models\Pdl::where('classification', $item['name'])
                                                ->where('jail_id', auth()->user()->jail_id)
                                                ->where('status', 'remand')
                                                ->count() +
                                                \App\Models\Pdl::where('classification', $item['name'])
                                                    ->where('jail_id', auth()->user()->jail_id)
                                                    ->where('status', 'release')
                                                    ->count());
                                    @endphp
                                    {{ $total < 0 ? 0 : $total }}
                                </span></h2>
                        </div>

                        <div>
                            <p class=" font-sans text-base font-medium text-gray-500">{{ $item['name'] }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    {{-- <div class="w-96 mt-10 ">
        <x-input wire:model.live="search" icon="search" placeholder="Search..." />
    </div>
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
                            {{ \App\Models\PdlCases::whereHas('pdl', function ($record) {
                                $record->where('jail_id', auth()->user()->jail_id);
                            })->where('crime_id', $item->id)->count() }}
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
    </div> --}}
</div>
