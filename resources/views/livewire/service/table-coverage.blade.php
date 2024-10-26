<div class="">

    <h1 class="font-bold">Area Coverage</h1>

    <input type="text" class="p-2 outline-none border border-slate-300 w-1/2" wire:model.live.debounce.300ms = "search"
        placeholder="Search Coverage">


    <div class="w-full flex pt-2 justify-center"
    wire:poll.debounce.1000ms>

        <table class="w-full table-auto border-collapse border border-slate-400">
            <thead>
                <tr class="bg-slate-200">
                    <th class="border border-slate-300 px-2 py-4">SERVICE ID.</th>
                    <th class="border border-slate-300 px-2 py-4">Area Name</th>


                    <th class="border border-slate-300 px-2 py-4">ACTION</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($coverages as $coverage)
                    <tr class="text-center">
                        <td class="border border-slate-300">{{ $coverage->subscriptionarea_id }}</td>
                        <td class="border border-slate-300">{{ $coverage->snarea_name }}</td>

                        <td class="border border-slate-300 px-2">
                            <button class=" bg-cyan-600 p-2 rounded text-slate-50 font-bold my-2"
                                x-on:click="$dispatch('open-modal', {name: 'update-coverage'})"
                                wire:click="selectCoverage({{ $coverage->subscriptionarea_id }})">
                                <i class="fa fa-add"></i>
                                Update
                            </button>

                            <button class=" bg-red-600 p-2 rounded text-slate-50 font-bold my-2"
                            x-data
                            x-on:click="$dispatch('open-modal', {name: 'delete-service'})"
                            wire:click="selectCoverage({{ $coverage->subscriptionarea_id }})">
                                <i class="fa fa-delete"></i>
                                Delete
                            </button>


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>


    @if ($selectedCoverage)
        <x-modal-form name="delete-service" title="Delete Service">
            @slot('body')
                <form wire:submit.prevent="deleteCoverage">
                    <div class="text-xl font-bold p-2">
                        <p>Do you want to delete this area ({{ $selectedCoverage->snarea_name }})?</p>
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

    <x-modal-form name="update-coverage" title="Update Coverage">
        @slot('body')
            <form wire:submit.prevent="saveUpdatedCoverage">

                @if ($errors->any())
                    <div class="bg-red-500 text-white p-2">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>

                @endif

                @if (session()->has('message'))
                    <div class="bg-green-500 text-white p-2">
                        {{ session('message') }}
                    </div>

                @endif
                <div class="flex justify-start my-2">

                    <div class="w-full">
                        <label for="">Area Name</label>
                        <input wire:model="area" type="text"
                            class="border border-slate-500 p-2 outline-none w-full" placeholder="Enter Area Name">
                    </div>



                    <div class="p-2 justify-items-end align-bottom">
                        <button type="submit" class="bg-cyan-500 rounded py-2 px-3 text-white mt-4">Update</button>
                    </div>
                </div>
            </form>
        @endslot
    </x-modal-form>
</div>
