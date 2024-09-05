<div class="p-2">

    <h1 class="font-bold my-2">Announcement</h1>
    <div class="grid grid-cols-3">
        <div class="">
            <label for="">Search Annnouncement</label>
            <input type="text" class="border border-slate-500 p-2 outline-none w-full" placeholder="Enter Announcement"
                wire:model.live.300ms="search">
            >
        </div>
    </div>
    <div class="w-full flex px-2 py-3 justify-center">

        <table class="w-full table-auto border-collapse border border-slate-400">
            <thead>
                <tr class="bg-slate-200">
                    <th class="border border-slate-300 px-2 py-4">

                        <input type="radio" name="select-all" id="select-all">

                    </th>
                    <th class="border border-slate-300 px-1 py-4">DELETE</th>

                    <th class="border border-slate-300 px-2 py-4">ANNOUNCEMENT ID</th>
                    <th class="border border-slate-300 px-2 py-4">ANNOUNCEMENT</th>
                    <th class="border border-slate-300 px-2 py-4">AREA</th>


                </tr>

            </thead>
            <tbody>
                @foreach ($announcements as $announcement)
                    <tr class="text-center">
                        <td class="border border-slate-300">{{ $announcement->announcement_id }}</td>
                        <td class="border border-slate-300">{{ $announcement->an_subject }}</td>
                        <td class="border border-slate-300">{{ $announcement->an_subject }}</td>
                        <td class="border border-slate-300">{{ $announcement->an_subject }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
