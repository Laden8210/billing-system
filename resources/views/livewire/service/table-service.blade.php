<div class="p-2">

    <h1 class="font-bold">Service Offered</h1>

    <input type="text" class="p-2 outline-none border border-slate-300 w-1/2" placeholder="Search Service"
    wire:model.live.debounce.300ms = "search">


    <div class="w-full flex p-2 justify-center" wire:poll.1s>

        <table class="w-full table-auto border-collapse border border-slate-400">
            <thead>
                <tr class="bg-slate-200">
                    <th class="border border-slate-300 px-2 py-4">SERVICE ID.</th>
                    <th class="border border-slate-300 px-2 py-4">BANDWIDTH (Mbps)</th>
                    <th class="border border-slate-300 px-2 py-4">TYPE</th>
                    <th class="border border-slate-300 px-2 py-4">SERVICE FEE</th>

                    <th class="border border-slate-300 px-2 py-4">ACTION</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($services as $service)
                <tr class="text-center">
                    <td class="border border-slate-300">{{ $service->subscription_plan_id }}</td>
                    <td class="border border-slate-300">{{ $service->bandwith }}</td>
                    <td class="border border-slate-300">Fiber Internet</td>
                    <td class="border border-slate-300">{{ $service->subscription_fee }}</td>

                    <td class="border border-slate-300 px-2">
                        <button class=" bg-cyan-600 p-2 rounded text-slate-50 font-bold text-xs my-2">

                            Update
                        </button>

                        <button class=" bg-red-600 p-2 rounded text-slate-50 font-bold text-xs my-2">
                            <i class="fa fa-delete"></i>
                            Delete
                        </button>


                    </td>

                </tr>
                @endforeach



            </tbody>
        </table>

    </div>
</div>
