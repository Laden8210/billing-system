<div class="p-2">

    <h1 class="font-bold my-2">Billing</h1>

    <div class="flex justify-between">

        <div class="flex justify-normal w-1/2">
            <div class="w-1/2 mx-2">
                <label for="">Search</label>
                <input type="text" class="p-2 outline-none border border-slate-300 w-full" placeholder="Search Coverage"
                    wire:model.live.debounce.300ms = "search">

            </div>

            <div class="w-1/2 mx-2">
                <label for="">Area</label>
                <select class="p-2 outline-none border border-slate-300 w-full" wire:model="area">
                    <option value="">All</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->snarea_name }}">{{ $area->snarea_name }}</option>
                    @endforeach
                </select>
            </div>


        </div>


    </div>


    <div class="w-full flex p-2 justify-center" wire:poll.debounce.1000ms>

        <table class="w-full table-auto border-collapse border border-slate-400">
            <thead>
                <tr class="bg-slate-200">
                    <th class="border border-slate-300 px-2 py-4">FULL NAME</th>
                    <th class="border border-slate-300 px-2 py-4">SUBSCRIPTION Number</th>
                    <th class="border border-slate-300 px-2 py-4">Area</th>

                    <th class="border border-slate-300 px-2 py-4">Billing Date</th>
                    <th class="border border-slate-300 px-2 py-4">Due Date</th>
                    <th class="border border-slate-300">Payment Amount</th>

                    <th class="border border-slate-300 px-2 py-4">STATUS</th>

                    <th class="border border-slate-300 px-2 py-4">ACTION</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($billings as $bill)
                    <tr class="text-center">


                        <td class="border border-slate-300 px-2 py-2">
                            {{ $bill->subscription->subscriber->sr_fname . ' ' . $bill->subscription->subscriber->sr_lname }}
                        </td>


                        <td class="border border-slate-300">
                            {{ $bill->subscription->sn_num }}
                        </td>

                        <td class="border border-slate-300">
                            {{ $bill->subscription->area->snarea_name }}
                        </td>

                        <td class="border border-slate-300">
                            {{ $bill->bs_billingdate }}
                        </td>

                        <td class="border border-slate-300">
                            {{ $bill->bs_duedate }}
                        </td>

                        <td class="border border-slate-300">
                            ₱{{ $bill->subscription->plan->snplan_fee }}
                        </td>

                        <td class="border border-slate-300">
                            @if ($bill->bs_status == 'unpaid')
                                <span class="px-3 py-1 text-white rounded-full bg-red-500">Unpaid</span>
                            @endif
                            @if ($bill->bs_status == 'paid')
                                <span class="px-3 py-1 text-white rounded-full bg-green-500">Paid</span>
                            @endif


                        <td class="border border-slate-300 px-2">

                            @if ($bill->bs_status == 'unpaid')

                            @endif
                            @if ($bill->bs_status == 'paid')
                                <button
                                    class="bg-cyan-400 hover:bg-cyan-600 px-3 py-1 rounded-full text-slate-50 font-bold my-2"
                                    x-data x-on:click="$dispatch('open-modal', {name:'view-billing-statement'})"
                                    wire:click="selectBilling({{ $bill->billstatement_id }})">
                                    View
                                </button>
                            @else
                                No Action
                            @endif


                        </td>


                    </tr>
                @endforeach

            </tbody>
        </table>

        <x-modal-form name="view-billing-statement" title="Billing Statement">
            @slot('body')
                @if ($selectedBilling)
                    <div class="p-2">
                        <div class="flex justify-between">
                            <div class="w-full">

                                <div class="grid grid-cols-2 gap-4">
                                    <p class="font-bold text-left">Subscriber Name:</p>
                                    <p class="text-right">{{ $selectedBilling->subscription->subscriber->sr_fname }}
                                        {{ $selectedBilling->subscription->subscriber->sr_lname }}</p>

                                    <p class="font-bold text-left">Subscription Number:</p>
                                    <p class="text-right">{{ $selectedBilling->subscription->sn_num }}</p>

                                    <p class="font-bold text-left">Billing Date:</p>
                                    <p class="text-right">{{ $selectedBilling->bs_billingdate }}</p>

                                    <p class="font-bold text-left">Due Date:</p>
                                    <p class="text-right">{{ $selectedBilling->bs_duedate }}</p>

                                    <p class="font-bold text-left">Previous Balance:</p>
                                    <p class="text-right">--</p> <!-- Assuming no data for this -->

                                    <p class="font-bold text-left">Balance Due:</p>
                                    <p class="text-right">
                                        {{ $selectedBilling->subscription->plan->snplan_fee - $selectedBilling->subscription->plan->snplan_fee * 0.12 }}
                                    </p>

                                    <p class="font-bold text-left">Vat:</p>
                                    <p class="text-right">{{ $selectedBilling->subscription->plan->snplan_fee * 0.12 }}</p>

                                    <p class="font-bold text-left">Total Amount:</p>
                                    <p class="text-right">{{ $selectedBilling->subscription->plan->snplan_fee }}</p>

                                    <p class="font-bold text-left">Payment Received:</p>
                                    <p class="text-right">{{ $selectedBilling->subscription->plan->snplan_fee }}</p>

                                    <p class="col-span-2 text-center">
                                        @if ($bill->bs_status == 'unpaid')
                                            <span class="px-3 py-1 text-white rounded-full bg-red-500">Unpaid</span>
                                        @endif
                                        @if ($bill->bs_status == 'paid')
                                            <span class="px-3 py-1 text-white rounded-full bg-green-500">Paid</span>
                                        @endif

                                    </p>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center" x-on:click="$dispatch('close-modal')">
                        <button class="bg-red-500 rounded px-2 py-2 text-white m-auto">Close</button>
                    </div>
                @endif
            @endslot
        </x-modal-form>

    </div>

</div>
