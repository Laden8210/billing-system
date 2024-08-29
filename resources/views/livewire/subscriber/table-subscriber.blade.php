<div class="p-2 w-full">

    <h1 class="font-bold text-2xl">Subscriber Information</h1>

    <div class="flex justify-between w-full my-2">

        <div>
            <h2>LIST OF SUBSCRIBER ACCOUNTS</h2>
        </div>

        <div class="inline-block">
            <label for="">Search</label>
            <input type="text" class="p-2 outline-none border border-slate-300" placeholder="(703) 488-6917">

        </div>



    </div>


    <div class="w-full flex  justify-center">

        <table class="w-full table-auto border-collapse border border-slate-400">
            <thead>
                <tr class="bg-slate-200">
                    <th class="border border-slate-300 px-2 py-4">USER ID</th>
                    <th class="border border-slate-300 px-2 py-4">CONTACT NO.</th>

                    <th class="border border-slate-300 px-2 py-4">USERNAME</th>
                    <th class="border border-slate-300 px-2 py-4">PASSWORD</th>
                    <th class="border border-slate-300 px-2 py-4">USER TYPE</th>
                    <th class="border border-slate-300 px-2 py-4">ACTION</th>
                </tr>

            </thead>
            <tbody>
                @for ($i = 0; $i < 10; $i++)
                    <tr class="text-center">
                        <td class="border border-slate-300">0000{{ $i }}</td>
                        <td class="border border-slate-300">09123456789</td>

                        <td class="border border-slate-300">JASPER-{{$i}}</td>


                        <td class="border border-slate-300">***</td>
                        <td class="border border-slate-300">Subscriber</td>


                        <td class="border border-slate-300 px-2">
                            <button class=" bg-cyan-600 p-2 rounded text-slate-50 font-bold my-2">

                                VIEW
                            </button>

                        </td>

                    </tr>
                @endfor


            </tbody>
        </table>

    </div>
</div>
