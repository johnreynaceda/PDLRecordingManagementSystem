<div x-data>
    <div class="flex justify-between items-end">
        <div class="w-64">
            <x-native-select label="Select Report" wire:model.live="selected_report">
                <option>Select an option</option>
                <option>Commit</option>
                <option>Hearing</option>
                <option>Remand</option>
                <option>Release</option>

            </x-native-select>
        </div>

    </div>
    <div>
        @switch($selected_report)
            @case('Commit')
                <livewire:admin.report.commit-report />
            @break

            @case('Hearing')
                <livewire:admin.report.hearing-report />
            @break

            @case('Remand')
                <livewire:admin.report.remand-report />
            @break

            @case('Release')
                <livewire:admin.report.release-report />
            @break

            @case('Overall')
                <div class="my-5 border-t flex justify-between items-end pt-5">
                    <div class="mt-10 border-t pt-3" x-ref="printContainer">
                        <div>
                            <h1 class="font-bold text-xl text-gray-600">PDL-CARPETA RECORD MANAGEMENT SYSTEM</h1>
                            <div class="flex space-x-1 leading-2 text-sm">
                                <h1 class="uppercase font-semibold">{{ auth()->user()->jail->name }}</h1>
                                <h1>({{ auth()->user()->jail->region->name }})</h1>
                            </div>
                        </div>
                        <div class="mt-5">
                            <canvas wire:ignore id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            @break

            @default
                <div class="my-5 border-t   items-end pt-5">

                    <div class="mt-10 border-t flex-1 pt-3" x-ref="printContainer">
                        <div>
                            <h1 class="font-bold text-xl text-gray-600">PDL-CARPETA RECORD MANAGEMENT SYSTEM</h1>
                            <div class="flex space-x-1 leading-2 text-sm">
                                <h1 class="uppercase font-semibold">{{ auth()->user()->jail->name }}</h1>
                                <h1>({{ auth()->user()->jail->region->name }})</h1>
                            </div>
                        </div>
                        <div class="mt-5">
                            <canvas wire:ignore id="myChart"></canvas>
                        </div>
                    </div>
                </div>
        @endswitch
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
    </script>
@endscript
