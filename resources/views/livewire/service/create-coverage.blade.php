<div class="">

    <h1 class="font-bold text-xl">Area of Coverage</h1>

    <form wire:submit.prevent="store">

        <div class="flex justify-start my-2">

            <div class="">
                <label for="">Area Name</label>
                <input wire:model="coverage" type="text" class="border border-slate-500 p-2 outline-none w-full"
                    placeholder="Enter Area Name">
            </div>

            <div class="p-2 justify-items-end align-bottom">
                <button class="bg-cyan-500 rounded py-2 px-3 text-white mt-4">Update</button>
            </div>

        </div>
    </form>
</div>
