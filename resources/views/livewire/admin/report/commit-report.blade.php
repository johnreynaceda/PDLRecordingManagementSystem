<div>
    <div class="my-5 border-t flex justify-between items-end pt-5">
        <div class="flex space-x-2 items-center">
            <div class="w-64">
                <x-input label="" placeholder="search..." wire:model.live="search" icon="search" />
            </div>
            <div class="w-64">
                <x-datetime-picker without-time without-timezone wire:model.live="date" />
            </div>

        </div>
        <div>
            <x-button label="Print Report" dark icon="printer" rounded class="font-semibold"
                @click="printOut($refs.printContainer.outerHTML);" />
        </div>
    </div>
    @if (auth()->user()->user_type != 'admin')
        <div class="w-64 mt-5">
            <x-native-select label="Region" wire:model.live="region">
                <option value="">Select an Option</option>
                @foreach ($regions as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </x-native-select>
        </div>
    @endif
    <div class="mt-10 border-t pt-3" x-ref="printContainer">
        <div>
            <h1 class="font-bold text-xl text-gray-600">PDL-CARPETA RECORD MANAGEMENT SYSTEM</h1>
            <div class="flex space-x-1 leading-2 text-sm">
                <h1 class="uppercase font-semibold">
                    {{ auth()->user()->user_type == 'admin' ? auth()->user()->jail->name : 'NATIONAL HEADQUARTERS' }}
                </h1>
                <h1>({{ auth()->user()->user_type == 'admin' ? auth()->user()->jail->region->name : '' }})</h1>
            </div>
        </div>
        <div class="mt-5">
            <table id="example" class="table-auto mt-5" style="width:100%">
                <thead class="font-normal">
                    <tr>
                        <th class="border-2  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                        </th>
                        <th class="border-2  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                            Fullname</th>
                        <th class="border-2  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                            Classification
                        </th>
                        <th class="border-2  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                            Date Commited
                        </th>
                        <th class="border-2  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                            Crime Commited
                        </th>
                        <th class="border-2  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                            Branch/Court
                        </th>
                        <th class="border-2  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                            Status
                        </th>
                        <th class="border-2  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                            Remarks
                        </th>
                    </tr>
                </thead>
                <tbody class="">
                    @php
                        $i = 1;
                    @endphp
                    @forelse ($commits as $commit)
                        <tr>
                            <td class="border-2 text-sm  text-gray-700  px-3 py-1">{{ $i++ }}
                            </td>
                            <td class="border-2 text-sm  text-gray-700  px-3 py-1">
                                {{ $commit->personalInformation->lastname . ', ' . $commit->personalInformation->firstname . ' ' . ($commit->personalInformation->middlename == null ? '' : $commit->personalInformation->middlename) }}
                            </td>
                            <td class="border-2 text-sm  text-gray-700  px-3 py-1">
                                {{ $commit->classification }}
                            </td>
                            <td class="border-2 text-sm  text-gray-700  px-3 py-1">
                                {{ \Carbon\Carbon::parse($commit->date_of_confinement)->format('F d, Y') }}
                            </td>
                            <td class="border-2 text-sm  text-gray-700  px-3 py-1">
                                {{ $commit->pdlCases->first()->crime->name }} and more..
                            </td>
                            <td class="border-2 text-sm  text-gray-700  px-3 py-1">
                                {{ $commit->court }}
                            </td>
                            <td class="border-2 text-sm  text-gray-700  px-3 py-1">
                                {{ $commit->status }}
                            </td>
                            <td class="border-2 text-sm  text-gray-700  px-3 py-1">
                                {{ $commit->remarks }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="border-2 text-sm  text-gray-700  px-3 py-1">
                                <span class="text-center">No Records Available</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
