<div>

    <h1 class="font-bold my-2">Reports</h1>

    <div class="flex justify-between">
        <h2 class="font-bold my-2">Select Report</h2>


        <div class="w-1/2 mx-2 flex justify-end">

            <div class="w-1/2 mx-2">
                <label for="">Area</label>
                <select name="" id="" class="p-2 outline-none border border-slate-300 w-full">
                    <option value="">Tupi</option>
                    <option value="">Koronadal</option>

                </select>
            </div>

            <div class="w-1/2 ">
                <br>

                <div class="bg-cyan-400 rounded-full px-2 py-1 text-slate-50 flex justify-normal">
                    <i class="far fa-calendar mt-1 mx-2"></i>
                    <p>Currently viewing: Jul 5, 2024</p>
                </div>
            </div>

        </div>
    </div>
    @if (session()->has('message'))
    <div class="bg-green-500 text-white p-2 rounded">
        {{ session('message') }}
    </div>

@endif

@if (session()->has('error'))
    <div class="bg-red-500 text-white p-2 rounded">
        {{ session('error') }}
    </div>

@endif

    <div class="grid grid-rows-3 grid-flow-col gap-5 p-2">



        <button href="{{ route('remittanceReport') }}" x-on:click="$dispatch('open-modal', {name:'filter-form'})"
            wire:click="selectReportType('Remittance Report')"
            class="bg-green-500 hover:bg-green-600 text-center p-10 text-xl text-white">Remittance Report</button>

        <button href="{{ route('paymentReport') }}" target="_blank"
            x-on:click="$dispatch('open-modal', {name:'filter-form'})" wire:click="selectReportType('Collection Report')"
            class="bg-green-500 hover:bg-green-600 text-center p-10 text-xl text-white">Collection Report</button>

        <button href="{{ route('subscriberReport') }}" target="_blank"
            x-on:click="$dispatch('open-modal', {name:'filter-form'})"
            wire:click="selectReportType('Subscriber Report')"
            class="bg-green-500 hover:bg-green-600 text-center p-10 text-xl text-white">Subscriber Report</button>

        <button href="{{ route('billingreport') }}" x-on:click="$dispatch('open-modal', {name:'filter-form'})"
            wire:click="selectReportType('Billing Report')" target="_blank"
            class="bg-green-500 hover:bg-green-600 text-center p-10 text-xl text-white">Billing Report</button>


        <button x-on:click="$dispatch('open-modal', {name:'filter-form'})"
            wire:click="selectReportType('Announcement Report')" href="{{ route('announcementreport') }}"
            target="_blank" class="bg-green-500 hover:bg-green-600 text-center p-10 text-xl text-white">Announcement
            Report</button>


        <button x-on:click="$dispatch('open-modal', {name:'filter-form'})"
            wire:click="selectReportType('Complaints Report')" href="{{ route('announcementreport') }}"
            target="_blank" class="bg-green-500 hover:bg-green-600 text-center p-10 text-xl text-white">Complaints
            Report</button>

    </div>


    <x-modal-form name='filter-form' title="Create Report">

        @slot('body')

            <form action="{{ route('generate-report') }}" method="POST" target="_blank">
                @csrf
                <h1>Generate Report for:</h1>
                <div class="grid grid-cols-1 gap-2">

                    <input type="text" value="{{ $reportType }}" name="reportType"
                        class="rounded px-2 py-1 bg-slate-200 outline" readonly>

                    <div>
                        <label for="">From</label>
                        <input type="date" class="p-2 outline-none border border-slate-300 w-full" name="start">
                    </div>

                    @if ($reportType != 'Collection Report' && $reportType != 'Remittance Report')
                        <div>
                            <label for="">End</label>
                            <input type="date" class="p-2 outline-none border border-slate-300 w-full" name="end">
                        </div>
                    @endif


                    @if ($reportType === 'Collection Report')
                        <div>
                            <label for="">Employee</label>
                            <select class="p-2 outline-none border border-slate-300 w-full" name="employee">
                                <option value="">Select</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->employee_id }}">
                                        {{ $employee->em_fname . ' ' . $employee->em_lname }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if ($reportType == 'Billing Report' || $reportType == 'Subscriber Report')
                        <div>
                            <label for="">To</label>
                            <select class="p-2 outline-none border border-slate-300 w-full" name="area">
                                <option value="">Select</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->subscriptionarea_id }}">{{ $area->snarea_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>

                <div class="flex justify-end mt-2">
                    <button class="bg-green-500 hover:bg-green-600 text-center p-2 text-white rounded">Filter</button>
                </div>
            </form>

        @endslot

    </x-modal-form>


</div>
