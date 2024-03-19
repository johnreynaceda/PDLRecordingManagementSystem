<div>
    <div class="bg-gray-200 py-3 text-center">
        <span class="font-bold text-main">JAIL POPULATION</span>
    </div>
    <div class=" mt-5 w-64">
        <label for="" class="text-white ">Jails</label>
        <x-native-select wire:model.live="jail">
            <option>Select An Option</option>
            @foreach ($jails as $region)
                <option value="{{ $region->id }}">{{ $region->name }}</option>
            @endforeach
        </x-native-select>
    </div>
    <div class="grid grid-cols-5 gap-4 mt-5">
        <div class="col-span-2 mt-2">
            <div class="grid grid-cols-2 gap-4">
                <div class="border-2 bg-white bg-opacity-50 rounded-xl grid place-content-center">
                    <center>
                        <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                            fill="currentColor">
                            <path d="M0 0h512v512H0z"></path>
                            <path fill="#fff"
                                d="M16 18v476h32V18zm144 0v279.883c5.308-1.866 10.97-2.883 16.885-2.883 5.262 0 10.323.812 15.115 2.303V18zm160 0v279.594c5.053-1.674 10.41-2.594 16-2.594s10.947.92 16 2.594V18zm144 0v476h32V18zM256 62.074c-17.06 0-33 9.87-45.242 27.46-.26.37-.504.764-.758 1.142v138.646c.254.378.5.772.758 1.143C223 248.053 238.94 257.925 256 257.925c17.06 0 33-9.872 45.242-27.46.26-.37.504-.765.758-1.143V90.676c-.254-.378-.5-.772-.758-1.143C289 71.945 273.06 62.073 256 62.073zM256 265c-17.772 0-32.922 2.757-46 7.697v34.387c14.584 11.926 23.885 31.442 23.885 52.916 0 21.474-9.3 40.99-23.885 52.916V494h92v-81.814c-14.076-11.984-23-31.147-23-52.186 0-21.04 8.924-40.202 23-52.186V272.65c-13.078-4.91-28.23-7.65-46-7.65zm-79.115 48c-20.835 0-39 20.24-39 47s18.165 47 39 47c16.12 0 30.634-12.123 36.38-30H176v-18h39.863c-.084-4.926-.78-9.62-2-14H176v-18h28.63c-7.182-8.72-17.112-14-27.745-14zM336 313c-10.633 0-20.563 5.28-27.746 14H336v18h-36.98c-1.217 4.38-1.914 9.074-2 14H336v18h-36.38c5.746 17.877 20.26 30 36.38 30 20.835 0 39-20.24 39-47s-18.165-47-39-47zm-207.094 82.04c-6.388 34.67-7.555 70.32-7.775 98.96H142v-82.584c-5.156-4.57-9.582-10.12-13.094-16.377zm254.492 1.036c-3.618 6.187-8.152 11.644-13.398 16.11V494h20.875c-.2-28.3-1.29-63.54-7.477-97.924zM160 422.116V494h32v-71.303c-4.792 1.49-9.853 2.303-15.115 2.303-5.915 0-11.577-1.017-16.885-2.883zm160 .29V494h32v-71.594c-5.053 1.674-10.41 2.594-16 2.594s-10.947-.92-16-2.594z">
                            </path>
                        </svg>
                        <div class="mt-3">
                            <h1 class="font-bold text-2xl">{{ $populations < 0 ? 0 : $populations }}</h1>
                            <p>Current Jail Population</p>
                        </div>
                    </center>
                </div>
                <div class=" flex flex-col space-y-3">
                    <div class="border-2 bg-white bg-opacity-50 rounded-xl">
                        <div class="py-3 text-center">
                            <h1 class="font-bold text-2xl">{{ $hearings }}</h1>
                            <p>Hearings</p>
                        </div>
                    </div>
                    <div class="border-2 bg-white bg-opacity-50 rounded-xl">
                        <div class="py-3 text-center">
                            <h1 class="font-bold text-2xl">{{ $remands }}</h1>
                            <p>Transfers/Remands</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 mt-4 gap-4">
                <div class="border-2 bg-white bg-opacity-50 rounded-xl py-3 grid place-content-center">
                    <center>
                        <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                            viewBox="0 0 24 24" fill="currentColor">
                            <g>
                                <rect fill="none" height="24" width="24"></rect>
                                <rect fill="none" height="24" width="24"></rect>
                            </g>
                            <g>
                                <g>
                                    <polygon points="22,9 22,7 20,7 20,9 18,9 18,11 20,11 20,13 22,13 22,11 24,11 24,9">
                                    </polygon>
                                    <path
                                        d="M8,12c2.21,0,4-1.79,4-4s-1.79-4-4-4S4,5.79,4,8S5.79,12,8,12z M8,6c1.1,0,2,0.9,2,2s-0.9,2-2,2S6,9.1,6,8S6.9,6,8,6z">
                                    </path>
                                    <path
                                        d="M8,13c-2.67,0-8,1.34-8,4v3h16v-3C16,14.34,10.67,13,8,13z M14,18H2v-0.99C2.2,16.29,5.3,15,8,15s5.8,1.29,6,2V18z">
                                    </path>
                                    <path
                                        d="M12.51,4.05C13.43,5.11,14,6.49,14,8s-0.57,2.89-1.49,3.95C14.47,11.7,16,10.04,16,8S14.47,4.3,12.51,4.05z">
                                    </path>
                                    <path
                                        d="M16.53,13.83C17.42,14.66,18,15.7,18,17v3h2v-3C20,15.55,18.41,14.49,16.53,13.83z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                        <div class="mt-3">
                            <h1 class="font-bold text-2xl">{{ $commits }}</h1>
                            <p>Commits</p>
                        </div>
                    </center>
                </div>
                <div class="border-2 bg-white bg-opacity-50 rounded-xl py-3 grid place-content-center">
                    <center>
                        <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                            viewBox="0 0 24 24" fill="currentColor">
                            <rect fill="none"></rect>
                            <path
                                d="M24,9v2h-6V9H24z M8,4C5.79,4,4,5.79,4,8s1.79,4,4,4s4-1.79,4-4S10.21,4,8,4z M8,10c-1.1,0-2-0.9-2-2s0.9-2,2-2s2,0.9,2,2 S9.1,10,8,10z M8,13c-2.67,0-8,1.34-8,4v3h16v-3C16,14.34,10.67,13,8,13z M14,18H2v-0.99C2.2,16.29,5.3,15,8,15s5.8,1.29,6,2V18z M12.51,4.05C13.43,5.11,14,6.49,14,8s-0.57,2.89-1.49,3.95C14.47,11.7,16,10.04,16,8S14.47,4.3,12.51,4.05z M16.53,13.83 C17.42,14.66,18,15.7,18,17v3h2v-3C20,15.55,18.41,14.49,16.53,13.83z">
                            </path>
                        </svg>
                        <div class="mt-3">
                            <h1 class="font-bold text-2xl">{{ $releases }}</h1>
                            <p>Releases</p>
                        </div>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-span-3 border-2 mt-2  bg-white bg-opacity-80 rounded-xl py-3 px-2 grid place-content-center">
            <span class="font-bold">OVERALL RESULT</span>
            <canvas class="mt-10" wire:ignore id="myChart"></canvas>
        </div>

    </div>
    <div class="bg-gray-200 py-3 mt-10 text-center">
        <span class="font-bold text-main">PDL CLASSIFICATION</span>
    </div>
    <div class="grid grid-cols-5 gap-4 mt-5">
        <div class="col-span-2 mt-2">
            <div class="mt-5 grid grid-cols-2 gap-5">
                <div class="border-2 bg-white bg-opacity-50 rounded-xl">
                    <div class="py-4 text-center">
                        <h1 class="font-bold text-2xl">{{ $ordinary ?? 0 }}</h1>
                        <p>ORDINARY PDL</p>
                    </div>
                </div>
                <div class="border-2 bg-white bg-opacity-50 rounded-xl">
                    <div class="py-4 text-center">
                        <h1 class="font-bold text-2xl">{{ $profiles ?? 0 }}</h1>
                        <p>HIGH PROFILES</p>
                    </div>
                </div>
                <div class="border-2 bg-white bg-opacity-50 rounded-xl">
                    <div class="py-4 text-center">
                        <h1 class="font-bold text-2xl">{{ $risks ?? 0 }}</h1>
                        <p>HIGH RISKS</p>
                    </div>
                </div>
                <div class="border-2 bg-white bg-opacity-50 rounded-xl">
                    <div class="py-4 text-center">
                        <h1 class="font-bold text-2xl">{{ $profile_risks ?? 0 }}</h1>
                        <p>HIGH PROFILES/HIGH RISKS</p>
                    </div>
                </div>
                <div class="border-2 bg-white bg-opacity-50 rounded-xl">
                    <div class="py-4 text-center">
                        <h1 class="font-bold text-2xl">{{ $municipal ?? 0 }}</h1>
                        <p>MUNICIPAL PDL</p>
                    </div>
                </div>
                <div class="border-2 bg-white bg-opacity-50 rounded-xl">
                    <div class="py-4 text-center">
                        <h1 class="font-bold text-2xl">{{ $city ?? 0 }}</h1>
                        <p>CITY PDL</p>
                    </div>
                </div>
                <div class="border-2 bg-white bg-opacity-50 rounded-xl">
                    <div class="py-4 text-center">
                        <h1 class="font-bold text-2xl">{{ $insular ?? 0 }}</h1>
                        <p>INSULAR PDL</p>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="col-span-3 border-2 mt-2 bg-white bg-opacity-80 relative rounded-xl py-3 px-2 grid place-content-center">
            <div class="absolute top-5 left-5 font-bold">
                OVERALL RESULT
            </div>
            <canvas wire:ignore id="myChart1"></canvas>

        </div>

    </div>


</div>
@script
    <script>
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: '',
                    data: @json($counts),
                    backgroundColor: [
                        '#1F2544',
                        '#337357',
                        '#FFD23F',
                        '#EE4266',
                    ],
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        const ctx1 = document.getElementById('myChart1');

        new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['ORDINARY PDL', 'HIGH PROFILES', 'HIGH RISKS', 'HIGH PROFILES/HIGH RISKS', 'MUNICIPAL PDL',
                    'CITY PDL', 'INSULAR PDL'
                ],
                datasets: [{
                    label: '# ',
                    data: [{{ $ordinary }}, {{ $profiles }}, {{ $risks }},
                        {{ $profile_risks }}, {{ $municipal }}, {{ $city }},
                        {{ $insular }},

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'left',
                    },

                },

            }
        });
    </script>
@endscript
