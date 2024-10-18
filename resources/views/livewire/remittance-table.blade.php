<div class="p-2">

    <h1 class="font-bold my-2">Payment</h1>

    <div class="flex justify-between">


    </div>


    <div class="flex justify-between">

        <div class="grid grid-cols-4 w-1/2 items-end">
            <div class="col-span-2">
                <label for="">Search</label>

                <input type="text" class="p-2 outline-none border border-slate-300 w-full" wire:model.live="search"
                    placeholder="Search">

            </div>
        </div>



    </div>


    <div class="w-full flex my-2 justify-center" wire:poll>

        <table class="w-full table-auto border-collapse border border-slate-400">
            <thead>
                <tr class="bg-slate-200">
                    <th class="border border-slate-300 px-2 py-4">Collector</th>
                    <th class="border border-slate-300 px-2 py-4">Area </th>
                    <th class="border border-slate-300 px-2 py-4">Date</th>
                    <th class="border border-slate-300 px-2 py-4">Proof</th>

                    <th class="border border-slate-300 px-2 py-4">Amount</th>


                </tr>

            </thead>
            <tbody>



                @foreach ($remittances as $index => $remittance)
                    <tr>
                        <td class="border border-slate-300">
                            {{ optional($remittance->employee)->em_fname ?? '' }}
                            {{ optional($remittance->employee)->em_lname ?? '' }}
                        </td>
                        <td class="border border-slate-300">
                            {{ $remittance->subscriptionArea->snarea_name }}
                        </td>
                        <td class="border border-slate-300">
                            {{ \Carbon\Carbon::parse($remittance->rm_date)->format('F j, Y') }}</td>
                        <td class="border border-slate-300 max-h-96">
                            <img class="max-h-96 object-contain" src="{{ url('' . $remittance->rm_image) }}"
                                class="proof-image" alt="{{ public_path('' . $remittance->rm_image) }}" />
                        </td>

                        <td class="border border-slate-300"><span
                                style="font-family: DejaVu Sans;">&#x20B1;</span>{{ $remittance->rm_amount }}</td>
                    </tr>
                @endforeach




            </tbody>
        </table>


    </div>
</div>
