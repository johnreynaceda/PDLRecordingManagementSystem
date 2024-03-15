<div>
    <div class="mt-5 grid grid-cols-4 gap-5">
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
    <div class="col-span-3 border-2 mt-5 bg-white relative bg-opacity-80 rounded-xl py-3 px-2 grid place-content-center"
        wire:ignore>
        <div class="absolute top-5 left-5">
            <span class="font-bold text-lg text-main">PDL DISTRIBUTION BY CLASSIFICATION</span>
        </div>
        <div class="h-[40rem] w-full">
            <canvas id="myChart" height="100px" width="900px"></canvas>
        </div>
        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['ORDINARY PDL', 'HIGH PROFILES', 'HIGH RISKS', 'HIGH PROFILES/HIGH RISKS', 'MUNICIPAL PDL',
                        'CITY PDL', 'INSULAR PDL'
                    ],
                    datasets: [{
                        label: '# ',
                        data: [{{ $ordinary }}, {{ $profiles }}, {{ $risks }},
                            {{ $profile_risks }}, {{ $municipal }}, {{ $insular }},
                            {{ $city }},

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

                    }
                }
            });
        </script>
    </div>
</div>
