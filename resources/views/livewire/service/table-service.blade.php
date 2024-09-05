<div class="p-2">

    <h1 class="font-bold">Service Offered</h1>

    <input type="text" class="p-2 outline-none border border-slate-300 w-1/2" placeholder="Search Service"
        wire:model.live.debounce.300ms = "search">


    <div class="w-full flex p-2 justify-center" wire:poll.1s>

        <table class="w-full table-auto border-collapse border border-slate-400">
            <thead>
                <tr class="bg-slate-200">
                    <th class="border border-slate-300 px-2 py-4">SERVICE ID.</th>
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

                        <td class="border border-slate-300">{{ $service->subscription_fee }}</td>

                        <td class="border border-slate-300 px-2">
                            <button class=" bg-cyan-600 p-2 rounded text-slate-50 font-bold text-xs my-2"
                             x-on:click="$dispatch('open-modal', {name: 'update-service'})"
                                wire:click="selectService({{ $service->subscription_plan_id }})">
                                Update
                            </button>

                            <button class=" bg-red-600 p-2 rounded text-slate-50 font-bold text-xs my-2" x-data
                                x-on:click="$dispatch('open-modal', {name: 'delete-service'})"
                                wire:click="selectService({{ $service->subscription_plan_id }})">
                                <i class="fa fa-delete"></i>
                                Delete
                            </button>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    @if ($selectedService)
        <x-modal-form name="delete-service" title="Delete Service">
            @slot('body')
                <form wire:submit.prevent="deleteService">
                    <div class="text-xl font-bold p-2">
                        <p>Do you want to delete this service ({{ $selectedService->bandwith }})?</p>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button class="bg-red-600 p-2 rounded text-slate-50 font-bold text-xs my-2"
                            x-on:click="$dispatch('close-modal')">
                            Cancel
                        </button>
                        <button class="bg-cyan-600 p-2 rounded text-slate-50 font-bold text-xs my-2" type="submit"
                            x-on:click="$dispatch('close-modal')">
                            Delete
                        </button>
                    </div>
                </form>
            @endslot
        </x-modal-form>
    @endif

    @if ($selectedService)
        <x-modal-form name="update-service" title="Update Service">
            @slot('body')
                <form wire:submit.prevent="updateService">

                    <div>
                        <div class=" ">
                            <label class="font-bold">Bandwidth (Mbps)</label>

                            <input type="text" wire:model="sbandwidth"
                                class="p-2 w-full  outline-none border border-slate-300" placeholder="Bandwidth">

                        </div>

                        <div class="">
                            <label class="font-bold">Type</label>

                            <input wire:model="type" type="text" class="p-2 w-full outline-none border border-slate-300"
                                placeholder="Type">

                        </div>

                        <div class="">
                            <label class="font-bold">Service Fee</label>

                            <input type="text" wire:model="price" class="p-2 w-full outline-none border border-slate-300"
                                placeholder="Service Fee">

                        </div>

                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" class="bg-red-600 p-2 rounded text-slate-50 font-bold text-xs my-2"
                            x-on:click="$dispatch('close-modal')">
                            Cancel
                        </button>
                        <button class="bg-cyan-600 p-2 rounded text-slate-50 font-bold text-xs my-2" type="submit"
                            x-on:click="$dispatch('close-modal')">
                            Update
                        </button>
                    </div>
                </form>
            @endslot
        </x-modal-form>
    @endif

</div>
