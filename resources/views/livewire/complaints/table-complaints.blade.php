 <div class="p-2">

     <h1 class="font-bold my-2">Complaints</h1>

     <div class="w-full flex p-2 justify-center">

         <table class="w-full table-auto border-collapse border border-slate-400">
             <thead>
                 <tr class="bg-slate-200">

                     <th class="border border-slate-300 px-1 py-4">COMPLAINTS ID</th>

                     <th class="border border-slate-300 px-2 py-4">FROM (SUBSCRIBER NAME)</th>
                     <th class="border border-slate-300 px-2 py-4">DESCRIPTION</th>
                     <th class="border border-slate-300 px-2 py-4">DATE</th>
                     <th class="border border-slate-300 px-2 py-4">REPLY</th>
                 </tr>
             </thead>
             <tbody>

                 @for ($i = 0; $i < 10; $i++)
                     <tr class="text-center">

                         <td class="border border-slate-300">0000{{ $i + 1 }}</td>


                         <td class="border border-slate-300">Jasper Dela Cruz</td>

                         <td class="border border-slate-300">Slow Internet</td>
                         <td class="border border-slate-300">10/10/2001</td>
                         <td class="border border-slate-300 ">
                             <button class="hover:bg-cyan-500 px-2 py-1 rounded-full hover:text-white" x-data
                                 x-on:click="$dispatch('open-modal', {name:'reply-modal'})"><i
                                     class="fas fa-reply"></i></button>
                         </td>
                     </tr>
                 @endfor
             </tbody>
         </table>

     </div>


     <x-modal-form name="reply-modal" title="Reply Complaints">
         @slot('body')
             <div class="grid grid-cols-2">
                 <div class="col-span-2 flex items-center justify-start text-lg mb-2">
                     <label for="" class="mr-2 font-bold">From:</label>
                     <span>Jasper Dela Cruz</span>
                 </div>
                 <div class="col-span-2">
                     <textarea name="" id="" class="border border-slate-300 rounded w-full p-2 outline-none"></textarea>

                     <div class="col-span-2 flex justify-end ">
                         <button class="bg-cyan-500 px-2 py-1 text-white">Reply</button>
                     </div>
                 </div>


             </div>
         @endslot
     </x-modal-form>

 </div>
