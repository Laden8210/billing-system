<div class="p-2">

    <h1 class="font-bold my-2">Payment</h1>

    <div class="flex justify-between">
        <h2 class="font-bold my-2">Subscription</h2>

        <div class="p-2">
            <div class="bg-cyan-400 rounded-full px-2 py-1 text-slate-50 flex justify-normal">
                <i class="far fa-calendar mt-1 mx-2"></i>
                <p>Currently viewing: Jul 5, 2024</p>
            </div>
        </div>
    </div>


    <div class="flex justify-between">

        <div class="flex justify-normal w-1/2">
            <div class="w-1/2 mx-2">
                <label for="">Search</label>
                <input type="text" class="p-2 outline-none border border-slate-300 w-full"
                    placeholder="Search Coverage">

            </div>
        </div>

        <div class="w-1/2 mx-2 flex justify-end">

            <div class="w-1/2 mx-2">
                <label for="">Area</label>
                <select name="" id="" class="p-2 outline-none border border-slate-300 w-full">
                    <option value="">Tupi</option>
                    <option value="">Koronadal</option>

                </select>
            </div>

            <div class="w-1/2 ">
                <label for="">Payment Type</label>
                <select name="" id="" class="p-2 outline-none border border-slate-300 w-full">
                    <option value="">Subscription Fee</option>

                </select>
            </div>

        </div>


    </div>


    <div class="w-full flex p-2 justify-center">

        <table class="w-full table-auto border-collapse border border-slate-400">
            <thead>
                <tr class="bg-slate-200">
                    <th class="border border-slate-300 px-2 py-4">SUBSCRIPTION ID</th>
                    <th class="border border-slate-300 px-2 py-4">FULLNAME</th>

                    <th class="border border-slate-300 px-2 py-4">SUBSCRIPTION PLAN</th>
                    <th class="border border-slate-300 px-2 py-4">AREA</th>
                    <th class="border border-slate-300 px-2 py-4">START DATE</th>
                    <th class="border border-slate-300 px-2 py-4">BILLING CYCLE</th>

                    <th class="border border-slate-300 px-2 py-4">ACTION</th>
                </tr>

            </thead>
            <tbody>
                @for ($i = 0; $i < 10; $i++)
                    <tr class="text-center">
                        <td class="border border-slate-300">0000{{ $i + 1 }}</td>
                        <td class="border border-slate-300">Jasper Dela Cruz</td>

                        <td class="border border-slate-300">50 Mbps Fiber</td>

                        <td class="border border-slate-300">Tupi</td>

                        <td class="border border-slate-300">02/02/2024</td>

                        <td class="border border-slate-300">2</td>

                        <td class="border border-slate-300 px-2">
                            <button
                                class="bg-cyan-600 px-3 py-1 rounded text-slate-50 my-2">
                                SUBSCRIPTION FEE
                            </button>

                        </td>

                    </tr>
                @endfor


            </tbody>
        </table>

    </div>
</div>
