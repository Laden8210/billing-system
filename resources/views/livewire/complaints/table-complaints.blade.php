<div class="p-2">

    <h1 class="font-bold my-2">Announcement</h1>

    <div class="w-full flex p-2 justify-center">

        <table class="w-full table-auto border-collapse border border-slate-400">
            <thead>
                <tr class="bg-slate-200">
                    <th class="border border-slate-300 px-2 py-4">

                        <input type="radio" name="select-all" id="select-all">

                    </th>
                    <th class="border border-slate-300 px-1 py-4">COMPLAINTS ID</th>

                    <th class="border border-slate-300 px-2 py-4">FROM (SUBSCRIBER NAME)</th>
                    <th class="border border-slate-300 px-2 py-4">DESCRIPTION</th>
                    <th class="border border-slate-300 px-2 py-4">REPLY</th>


                </tr>

            </thead>
            <tbody>

                @for ($i = 0; $i < 10; $i++)
                    <tr class="text-center">
                        <td class="border border-slate-300"> <input type="radio" name="select-all" id="select-all">
                        </td>
                        <td class="border border-slate-300">0000{{ $i + 1 }}</td>


                        <td class="border border-slate-300">Jasper Dela Cruz</td>

                        <td class="border border-slate-300">Slow Internet</td>
                        <td class="border border-slate-300 ">
                            <button class="hover:bg-cyan-500 px-2 py-1 rounded-full hover:text-white"><i class="fas fa-reply"></i></button>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>

    </div>
</div>
