<div class="">

    <h1 class="font-bold text-xl">Announcement</h1>

    <div class="p-2">
        <h2 class="font-bold text-xl">POST ANNOUNCEMENT</h2>
        <form wire:submit.prevent="store">
            <div class="flex justify-between my-2">
                <div class="flex justify-normal mx-2">

                    <div class="w-1/2">
                        <label for="">Subject</label>
                        <input type="text" wire:model="an_subject"
                            class="border border-slate-500 p-2 outline-none w-full" placeholder="Enter Subject">
                    </div>



                </div>

            </div>
            <div class="flex justify-between my-2">

                <div class="w-full">
                    <label for="">Announcement</label>
                    <textarea wire:model="an_message" name="" id="" cols="30" rows="10"
                        class="border border-slate-500 p-2 outline-none w-full h-24"></textarea>
                </div>

                <div class="w-auto m-2 text-center p-3">
                    <button class="p-2 rounded bg-cyan-500 text-white" type="submit">Post</button>
                </div>

            </div>
        </form>
    </div>
</div>
