<div class="p-2">

    <h1 class="font-bold my-2">Payment</h1>

    <div class="flex justify-between">


    </div>


    <div class="flex justify-between">

        <div class="grid grid-cols-4 w-1/2 items-end">
            <div class="col-span-2">
                <label for="">Search</label>

                <input type="text" class="p-2 outline-none border border-slate-300 w-full"
                wire:model.live="search"
                placeholder="Search">

            </div>
        </div>



    </div>


    <div class="w-full flex my-2 justify-center"
    wire:poll.debounce.1000ms>

        <table class="w-full table-auto border-collapse border border-slate-400">
            <thead>
                <tr class="bg-slate-200">
                    <th class="border border-slate-300 px-2 py-4">BILL ID.</th>
                    <th class="border border-slate-300 px-2 py-4">FNAME</th>
                    <th class="border border-slate-300 px-2 py-4">LNAME</th>
                    <th class="border border-slate-300 px-2 py-4">Minitial</th>
                    <th class="border border-slate-300 px-2 py-4">Suffix</th>
                    <th class="border border-slate-300 px-2 py-4">SUBSCRIPTION Number</th>
                    <th class="border border-slate-300 px-2 py-4">Area</th>

                    <th class="border border-slate-300 px-2 py-4">STATUS</th>

                    <th class="border border-slate-300 px-2 py-4">ACTION</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($billings as $bill)
                    <tr class="text-center">
                        <td class="border border-slate-300">{{ $bill->billstatement_id }}</td>
                        <td class="border border-slate-300">{{ $bill->subscription->subscriber->sr_fname }}</td>

                        <td class="border border-slate-300">
                            {{ $bill->subscription->subscriber->sr_lname }}
                        </td>

                        <td class="border border-slate-300">
                            {{ $bill->subscription->subscriber->sr_minitial ?? 'N/A' }}

                        <td class="border border-slate-300">
                            {{ $bill->subscription->subscriber->sr_suffix ?? 'N/A' }}
                        </td>
                        <td class="border border-slate-300">
                            {{ $bill->subscription->sn_num }}
                        </td>

                        <td class="border border-slate-300">
                            {{ $bill->subscription->area->snarea_name }}
                        </td>

                        <td class="border border-slate-300">
                            @if ($bill->bs_status == 'unpaid')
                                <span class="px-3 py-1 text-white rounded-full bg-red-500">Unpaid</span>
                            @endif
                            @if ($bill->bs_status == 'paid')
                                <span class="px-3 py-1 text-white rounded-full bg-green-500">Paid</span>
                            @endif


                        <td class="border border-slate-300 px-2">
                            <button
                                class="bg-cyan-400 hover:bg-cyan-600 px-3 py-1 rounded-full text-slate-50 font-bold my-2"
                                x-data x-on:click="$dispatch('open-modal', {name:'view-billing-statement'})"
                                wire:click="selectBilling({{ $bill->billstatement_id }})"
                                @if ($bill->bs_status == 'paid') disabled @endif>


                                Pay Subscription
                            </button>

                        </td>


                    </tr>
                @endforeach

            </tbody>
        </table>


        <x-modal-form name="view-billing-statement" title="Record Payment">

            @slot('body')
                <form wire:submit.prevent="recordPayment">
                    @if ($selectedBilling)
                        <div class="p-2">
                            @if (session()->has('message'))
                                <div class="w-full py-2 px-2 bg-green-200 rounded">
                                    <span class="text-green-900">{{ session('message') }}</span>
                                </div>
                            @endif
                            @if (session()->has('error'))
                            <div class="w-full py-2 px-2 bg-red-200 rounded mb-2">
                                <span class="text-red-900">{{ session('error') }}</span>
                            </div>
                        @endif
                            <div class="flex justify-between">
                                <div class="w-full">

                                    <p class="font-bold">Bill ID: {{ $selectedBilling->billstatement_id }}</p>

                                    <p class="font-bold">Subscriber Name:
                                        {{ $selectedBilling->subscription->subscriber->sr_fname }}
                                        {{ $selectedBilling->subscription->subscriber->sr_lname }}</p>
                                    <p class="font-bold">Subscription Number: {{ $selectedBilling->subscription->sn_num }}
                                    </p>
                                    <p class="font-bold">Subscription Fee:
                                        {{ $selectedBilling->subscription->plan->snplan_fee }}</p>

                                    <div class="mt-2 w-full">
                                        <label for="month" class="font-bold">Month</label>
                                        <input type="number"
                                            class="w-full outline-none border rounded border-slate-500 px-2 py-3"
                                            wire:model="totalMonth">

                                        @error('totalMonth')
                                            <p class="text-red-500 text-xs italic mt-1"><i
                                                    class="fas fa-exclamation-circle"></i></i>{{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="mt-2 w-full">
                                        <label for="month" class="font-bold">Payment</label>
                                        <input type="number"
                                            class="w-full outline-none border rounded border-slate-500 px-2 py-3"
                                            wire:model="amount">
                                            @error('amount')
                                            <p class="text-red-500 text-xs italic mt-1"><i
                                                    class="fas fa-exclamation-circle"></i></i>{{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="flex justify-center">
                            <button class="bg-blue-500 hover:bg-blue-700 rounded px-2 py-2 text-white m-auto"
                                type="submit">Record
                                Payment</button>
                        </div>
                    @endif
                </form>
            @endslot
        </x-modal-form>


    </div>
</div>
