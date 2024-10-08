 <div class="p-2">

     <h1 class="font-bold my-2">Complaints</h1>

     <div>
        <input type="text" placeholder="Search" wire:model.live.debounce.300ms = "search"
        class="border border-slate-400 p-2 active:outline-none w-1/2 mx-2 h-10 self-end">
    </div>

     <div class="w-full flex p-2 justify-center" wire:poll.debounce.1000ms>


         <table class="w-full table-auto border-collapse border border-slate-400">
             <thead>
                 <tr class="bg-slate-200">

                     <th class="border border-slate-300 px-1 py-4">COMPLAINTS ID</th>

                     <th class="border border-slate-300 px-2 py-4">FROM (SUBSCRIBER NAME)</th>
                     <th class="border border-slate-300 px-2 py-4">DESCRIPTION</th>
                     <th class="border border-slate-300 px-2 py-4">DATE</th>
                     <th class="border border-slate-300 px-2 py-4">REPLY</th>
                     <th class="border border-slate-300 px-2 py-4">ACTION</th>
                 </tr>
             </thead>
             <tbody>

                @foreach ($complaints as $complain)
                    <tr class="text-center">
                        <td class="border border-slate-300">
                            {{ $complain->complaint_id }}
                        </td>
                        <td class="border border-slate-300">
                            {{$complain->subscriber->sr_fname}} {{$complain->subscriber->sr_lname}}
                        </td>
                        <td  class="border border-slate-300">
                            {{$complain->cp_message}}
                        </td>
                        <td  class="border border-slate-300">
                            {{$complain->created_at}}
                        </td>

                        <td class="border border-slate-300">
                            {{$complain->cp_reply}}

                        </td>

                        <td class="border border-slate-300 ">

                            <button class="hover:bg-cyan-500 px-2 py-1 rounded-full hover:text-white" x-data
                                x-on:click="$dispatch('open-modal', {name:'reply-modal'})"
                                wire:click="selectComplaint({{$complain->complaint_id}})"><i
                                    class="fas fa-reply"></i></button>

                        </td>

                    </tr>
                @endforeach

             </tbody>
         </table>

     </div>

     @if ($selectedcomplaints)

     <x-modal-form name="reply-modal" title="Reply Complaints">
         @slot('body')

            <form wire:submit.prevent="replyComplaints">
                @if (session()->has('message'))
                <div class="w-full py-2 px-2 bg-green-200 rounded">
                    <span class="text-green-900">{{ session('message') }}</span>
                </div>
            @endif
             <div class="grid grid-cols-2">
                 <div class="col-span-2 flex items-center justify-start text-lg mb-2">
                     <label for="" class="mr-2 font-bold">From:</label>
                     <span>{{$selectedcomplaints->subscriber->sr_fname .' '. $selectedcomplaints->subscriber->sr_lnam}}</span>
                 </div>
                 <div class="col-span-2">
                     <textarea name="" id="" class="border border-slate-300 rounded w-full p-2 outline-none"
                     wire:model="reply"
                     ></textarea>

                     <div class="col-span-2 flex justify-end ">
                         <button type="submit" class="bg-cyan-500 px-2 py-1 text-white">Reply</button>
                     </div>
                 </div>


             </div>
            </form>
         @endslot
     </x-modal-form>

     @endif

 </div>
