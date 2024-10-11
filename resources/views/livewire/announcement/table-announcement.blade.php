<div class="p-2">

    <h1 class="font-bold my-2">Announcement</h1>
    <div class="grid grid-cols-5 items-baseline gap-2">
        <div class="">
            <label for="">Search Annnouncement</label>
            <input type="text" class="border border-slate-500 p-2 outline-none w-full" placeholder="Enter Announcement"
                wire:model.live.300ms="search">

        </div>

        <div class="">
            <label for="">Select Date</label>
            <input type="date" class="border border-slate-500 p-2 outline-none w-full" placeholder="Select Date"
            wire:model.live.300ms="date">
        </div>
    </div>
    <div class="w-full flex px-2 py-3 justify-center" wire:poll.debounce.1000ms>

        <table class="w-full table-auto border-collapse border border-slate-400">
            <thead>
                <tr class="bg-slate-200">

                    <th class="border border-slate-300 px-2 py-4">ANNOUNCEMENT ID</th>
                    <th class="border border-slate-300 px-2 py-4">SUBJECT</th>
                    <th class="border border-slate-300 px-2 py-4">ANNOUNCEMENT</th>
                    <th class="border border-slate-300 px-2 py-4">DATE</th>
                    <th class="border border-slate-300 px-2 py-4">VIEW</th>
                    <th class="border border-slate-300 px-2 py-4">ACTION</th>

                </tr>

            </thead>
            <tbody>
                @foreach ($announcements as $announcement)
                    <tr class="text-center">
                        <td class="border border-slate-300 py-3">{{ $announcement->announcement_id }}</td>
                        <td class="border border-slate-300 py-3">{{ $announcement->an_subject }}</td>
                        <td class="border border-slate-300 py-3">{{ $announcement->an_message }}</td>
                        <td class="border border-slate-300 py-3">{{ $announcement->an_date }}</td>
                        <td class="border border-slate-300 py-3">
                            <button class="px-2 py-1 bg-blue-600 rounded hover:bg-blue-700 text-white"
                            x-data  x-on:click="$dispatch('open-modal', {name:'view-announcement'})"
                            ><i class="fa fa-eye" aria-hidden="true"></i></button>
                        </td>

                        <td class="border border-slate-300 py-3">
                            <button class="px-2 py-1 bg-red-600 rounded hover:bg-red-700 text-white font-semibold "
                            x-data  x-on:click="$dispatch('open-modal', {name:'delete-announcement'})"
                            wire:click="delete({{$announcement->announcement_id }})">Delete</button>
                        </td>


                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <div class="w-full flex justify-center">
        {{ $announcements->links() }}
    </div>



    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 my-2 text-center">
            {{ session('message') }}
        </div>


    @endif


    @if ($announcement)
    <x-modal-form name="delete-announcement" title="Delete Announcement">
        @slot('body')

            <p class="">Are you sure you want to delete this announcement?</p>


        <div class="flex justify-end"><button wire:click="confirmDelete" class="text-white bg-red-700 hover:bg-red-900 rounded py-2 px-2">Delete</button></div>
        @endslot
    </x-modal-form>

    @endif

    @if ($announcement)
    <x-modal-form name="view-announcement" title="Announcement Detais">
        @slot('body')
        <div class="shadow-lg py-2 px-2 rounded">
             {{$announcement->an_message}}
        </div>
        @endslot
    </x-modal-form>
    @endif

</div>
