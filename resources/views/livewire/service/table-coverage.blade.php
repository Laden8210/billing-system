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
                            <button class=" bg-cyan-600 p-2 rounded text-slate-50 font-bold my-2">
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
</div>
