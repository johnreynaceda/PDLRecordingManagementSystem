<div>
    <div class="w-64">
        <x-native-select label="Select Report" wire:model.live="selected_report">
            <option>Select an option</option>
            <option>Commit</option>
            <option>Hearing</option>
            <option>Remand</option>
            <option>Release</option>
        </x-native-select>
    </div>
    <div class="mt-10">

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
        <div class="w-64 mt-5">
            <x-native-select label="Jail" wire:model.live="jail">
                <option value="">Select an Option</option>
                @foreach ($jails as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </x-native-select>
        </div>
        <div class="mt-10 border-t pt-3" x-ref="printContainer">
            <h1 class="font-bold text-xl text-gray-600">PDL-CARPETA RECORD MANAGEMENT SYSTEM</h1>
            <div class="flex space-x-1 leading-2 text-sm">
                <h1 class="uppercase text-lg font-semibold">
                    {{ auth()->user()->region->name }}
                </h1>
            </div>
            @if ($selected_report == 'Commit')
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
            @elseif ($selected_report == 'Hearing')
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
                                    Criminal Case No.
                                </th>
                                <th class="border-2  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                    Crime Commited
                                </th>
                                <th class="border-2  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                    Branch/Court
                                </th>

                                <th class="border-2  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                    Cell/Location
                                </th>

                                <th class="border-2  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                    Hearing Date/Schedule
                                </th>
                                <th class="border-2 w-40  text-left px-2 text-sm font-semibold text-gray-700 py-2">

                                </th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @php
                                $i = 1;
                            @endphp
                            @forelse ($hearings as $commit)
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
                                        {{ $commit->criminal_case_no }}
                                    </td>

                                    <td class="border-2 text-sm  text-gray-700  px-3 py-1">
                                        {{ $commit->pdlCases->first()->crime->name }} and more..
                                    </td>
                                    <td class="border-2 text-sm  text-gray-700  px-3 py-1">
                                        {{ $commit->court }}
                                    </td>
                                    <td class="border-2 text-sm  text-gray-700  px-3 py-1">
                                        {{ $commit->cell_location }}
                                    </td>
                                    <td class="border-2 text-sm  text-gray-700  px-3 py-1">
                                        <ul>
                                            @foreach ($commit->pdlHearings as $item)
                                                @if ($date)
                                                    @if ($item->date_of_hearing == $date)
                                                        <li>{{ \Carbon\Carbon::parse($item->date_of_hearing)->format('F d, Y') . ' - ' . \Carbon\Carbon::parse($item->time_of_hearing)->format('h:i A') }}
                                                        </li>
                                                    @endif
                                                @else
                                                    <li>{{ \Carbon\Carbon::parse($item->date_of_hearing)->format('F d, Y') . ' - ' . \Carbon\Carbon::parse($item->time_of_hearing)->format('h:i A') }}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="border-2 text-sm  text-gray-700  px-3 py-1">

                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="border-2 text-sm  text-gray-700  px-3 py-1">
                                        <span class="text-center">No Records Available</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @elseif ($selected_report == 'Remand')
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
                                    Criminal Case No.
                                </th>
                                <th class="border-2  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                    Crime Commited
                                </th>
                                <th class="border-2  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                    Cell/Location
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
                                <th class="border-2  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                    Date of Release
                                </th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @php
                                $i = 1;
                            @endphp
                            @forelse ($remands as $commit)
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
                                        {{ $commit->criminal_case_no }}
                                    </td>
                                    <td class="border-2 text-sm  text-gray-700  px-3 py-1">
                                        {{ $commit->pdlCases->first()->crime->name }} and more..
                                    </td>
                                    <td class="border-2 text-sm  text-gray-700  px-3 py-1">
                                        {{ $commit->cell_location }}
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
                                    <td class="border-2 text-sm  text-gray-700  px-3 py-1">
                                        {{ \Carbon\Carbon::parse($commit->date_of_remand)->format('F d, Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="border-2 text-sm  text-gray-700  px-3 py-1">
                                        <span class="text-center">No Records Available</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @elseif($selected_report == 'Release')
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
                                    Criminal Case No.
                                </th>
                                <th class="border-2  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                    Crime Commited
                                </th>
                                <th class="border-2  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                    Cell/Location
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
                                <th class="border-2  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                    Date of Release
                                </th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @php
                                $i = 1;
                            @endphp
                            @forelse ($releases as $commit)
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
                                        {{ $commit->criminal_case_no }}
                                    </td>
                                    <td class="border-2 text-sm  text-gray-700  px-3 py-1">
                                        {{ $commit->pdlCases->first()->crime->name }} and more..
                                    </td>
                                    <td class="border-2 text-sm  text-gray-700  px-3 py-1">
                                        {{ $commit->cell_location }}
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
                                    <td class="border-2 text-sm  text-gray-700  px-3 py-1">
                                        {{ \Carbon\Carbon::parse($commit->date_of_release)->format('F d, Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="border-2 text-sm  text-gray-700  px-3 py-1">
                                        <span class="text-center">No Records Available</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
</div>
