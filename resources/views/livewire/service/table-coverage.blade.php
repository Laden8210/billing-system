<div class="p-2">

    <h1 class="font-bold">Area Coverage</h1>

    <input type="text" class="p-2 outline-none border border-slate-300 w-1/2" wire:model.live.debounce.300ms = "search"
        placeholder="Search Coverage">


    <div class="w-full flex p-2 justify-center">

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
                        <td class="border border-slate-300">{{ $coverage->subcription_area_id }}</td>
                        <td class="border border-slate-300">{{ $coverage->area_name }}</td>

                        <td class="border border-slate-300 px-2">
                            <button class=" bg-cyan-600 p-2 rounded text-slate-50 font-bold my-2"
                            x-on:click="$dispatch('open-modal', {name: 'update-coverage'})"
                            wire:click="selectCoverage({{$coverage->subcription_area_id }})"
                            >
                                <i class="fa fa-add"></i>
                                Update
                            </button>

                            <button class=" bg-red-600 p-2 rounded text-slate-50 font-bold my-2">
                                <i class="fa fa-delete"></i>
                                Delete
                            </button>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <x-modal-form name="update-coverage" title="Update Coverage">
        @slot('body')
        <form wire:submit.prevent="store">

            <div class="flex justify-start my-2">

                <div class="">
                    <label for="">Area Name</label>
                    <input wire:model="updateCoverage" type="text" class="border border-slate-500 p-2 outline-none w-full"
                        placeholder="Enter Area Name">
                </div>

                <div class="p-2 justify-items-end align-bottom">
                    <button class="bg-cyan-500 rounded py-2 px-3 text-white mt-4">Add</button>
                </div>
            </div>
        </form>
        @endslot
    </x-modal-form>
</div>
