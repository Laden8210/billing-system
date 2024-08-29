<div class="p-2">

    <h1 class="font-bold my-2">Area Coverage</h1>

    <div class="flex justify-between">

        <div class="flex justify-normal w-1/2">
            <div class="w-1/2 mx-2">
                <label for="">Search</label>
                <input type="text" class="p-2 outline-none border border-slate-300 w-full" placeholder="Search Coverage">

            </div>


            <div class=" w-1/2 mx-2 ">
                <label for="">Area</label>
                <select class="p-2 outline-none border border-slate-300 w-full">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>

            </div>


        </div>

        <div class="p-2" >
            <div class="bg-cyan-400 rounded-full px-2 py-1 text-slate-50 flex justify-normal">
                <i class="far fa-calendar mt-1 mx-2"></i>
                <p>Currently viewing: Jul 5, 2024</p>
            </div>
        </div>
    </div>


    <div class="w-full flex p-2 justify-center">

        <table class="w-full table-auto border-collapse border border-slate-400">
            <thead>
                <tr class="bg-slate-200">
                    <th class="border border-slate-300 px-2 py-4">BILL ID.</th>
                    <th class="border border-slate-300 px-2 py-4">NAME</th>

                    <th class="border border-slate-300 px-2 py-4">BILLING CYCLE</th>
                    <th class="border border-slate-300 px-2 py-4">SUBSCRIPTION PLAN</th>
                    <th class="border border-slate-300 px-2 py-4">STATUS</th>

                    <th class="border border-slate-300 px-2 py-4">ACTION</th>
                </tr>

            </thead>
            <tbody>
                @for ($i = 0; $i < 10; $i++)
                    <tr class="text-center">
                        <td class="border border-slate-300">0000{{ $i+1 }}</td>
                        <td class="border border-slate-300">Jasper Dela Cruz</td>

                        <td class="border border-slate-300">5</td>

                        <td class="border border-slate-300">50 Mbps Fiber</td>

                        <td class="border border-slate-300"><span class="px-3 py-1 text-white rounded-full bg-green-500">Paid</span></td>

                        <td class="border border-slate-300 px-2">
                            <button class=" hover:bg-cyan-600 px-3 py-1 rounded-full hover:text-slate-50 font-bold my-2">
                                <i class="far fa-eye"></i>
                            </button>

                        </td>

                    </tr>
                @endfor


            </tbody>
        </table>

    </div>
</div>
