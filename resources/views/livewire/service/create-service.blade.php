<div class="my-2">
    <h1 class="font-bold text-xl">Services</h1>

    <form wire:submit.prevent="store">
        <div class=" w-3/4">
            <label class="font-bold">Bandwidth (Mbps)</label>

            <input type="text" wire:model="bandwidth" class="p-2 w-full  outline-none border border-slate-300" placeholder="Search Service">

        </div>


        <div class="w-full flex justify-between ">

            <div class="w-3/4">
                <label class="font-bold">Service Fee</label>

                <input type="text" wire:model="price" class="p-2 w-full outline-none border border-slate-300"
                    placeholder="Search Service">

            </div>

            <div class="w-1/4 flex justify-center">
                <button class="bg-cyan-600 p-2 rounded text-slate-50 font-bold my-2 ">
                    <i class="fa fa-add"></i>
                    ADD </button>
            </div>
        </div>
    </form>

</div>
