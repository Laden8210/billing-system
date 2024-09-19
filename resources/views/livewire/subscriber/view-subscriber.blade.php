<div class="p-2 w-full">

    <h1 class="font-bold text-2xl">Subscriber Information</h1>

    <div class="w-full mt-5">
        <h2>Account Information</h2>

        <h3 class="text-base mt-10 mb-2">Subsciber Id: {{ $subscriber->subscriber_id }}</h3>

        <div class="flex justify-between">
            <div class="grid grid-cols-5 items-center gap-5 w-11/12">
                <div>
                    <p class="text-base font-bold">First Name: <span
                            class="font-normal">{{ $subscriber->sr_fname }}</span></p>
                </div>

                <div>
                    <p class="text-base font-bold">Last Name: <span class="font-normal">{{ $subscriber->sr_lname }}</span>
                    </p>
                </div>

                <div>
                    <p class="text-base font-bold">Middle Name: <span
                            class="font-normal">{{ $subscriber->sr_mname }}</span></p>
                </div>

                <div>
                    <p class="text-base font-bold">Suffix: <span class="font-normal">{{ $subscriber->sr_suffix }}</span>
                    </p>
                </div>

                <div>
                    <p class="text-base font-bold">Contact Number: <span
                            class="font-normal">{{ $subscriber->sr_contactnum }}</span>
                    </p>
                </div>


                <div>
                    <p class="text-base font-bold">Street: <span class="font-normal">{{ $subscriber->sr_street }}</span>
                    </p>
                </div>


                <div>
                    <p class="text-base font-bold">City: <span class="font-normal">{{ $subscriber->sr_city }}</span></p>

                </div>

                <div>
                    <p class="text-base font-bold">Province: <span
                            class="font-normal">{{ $subscriber->sr_province }}</span>
                    </p>
                </div>

            </div>

            <div class="flex justify-start items-center">
                <button class="bg-blue-900 p-2 text-white rounded hover:bg-blue-700">Update</button>
            </div>
        </div>


        <hr class="my-5">
        <div class="flex justify-between items-center my-5">
            <h2 class="font-bold">Subscriptions</h2>
            <button class="rounded p-2 bg-blue-900 hover:bg-blue-700 text-white"
            x-data x-on:click="$dispatch('open-modal', {name:'create-subscription-modal'})" >Add</button>
        </div>
        <div wire:poll.1s>
            <table class="w-full table-auto border-collapse border border-slate-400">
                <thead>
                    <tr>
                        <th class="border border-slate-300 px-2 py-4">
                            Subscription Id
                        </th>
                        <th class="border border-slate-300 px-2 py-4">
                            Subscription Number
                        </th>
                        <th class="border border-slate-300 px-2 py-4">
                            Subscription Plan
                        </th>
                        <th class="border border-slate-300 px-2 py-4">
                            Subscription Area
                        </th>
                        <th class="border border-slate-300 px-2 py-4">
                            Start Date
                        </th>
                        <th class="border border-slate-300 px-2 py-4">
                            Status
                        </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subscriptions as $subscription)
                        <tr>
                            <td class="border border-slate-300 px-2 py-4">
                                {{ $subscription->subscription_id }}
                            </td>
                            <td class="border border-slate-300 px-2 py-4">
                                {{ $subscription->sn_num }}
                            </td>
                            <td class="border border-slate-300 px-2 py-4">
                                {{ $subscription->plan->snplan_bandwidth }} mbps
                            </td>
                            <td class="border border-slate-300 px-2 py-4">
                                {{ $subscription->area->snarea_name }}
                            </td>
                            <td class="border border-slate-300 px-2 py-4">
                                {{$subscription->sn_startdate}}
                            </td>
                            <td class="border border-slate-300 px-2 py-4">
                                {{$subscription->sn_status}}
                            </td>
                            <td class="border border-slate-300 px-2 py-4 text-center">
                                <button class="bg-blue-900 p-2 text-white rounded hover:bg-blue-700"
                                wire:click="selectSubscription({{ $subscription->subscription_id }})"
                                x-data x-on:click="$dispatch('open-modal', {name:'update-subscription-modal'})" >Update</button>
                                <button class="bg-green-900 p-2 text-white rounded hover:bg-green-700"
                                wire:click="activate({{ $subscription->subscription_id}})">Activate</button>
                                <button class="bg-red-900 p-2 text-white rounded hover:bg-red-700"
                                 wire:click="deactivate({{ $subscription->subscription_id}})">Deactivate</button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>




    <x-modal-form name="create-subscription-modal" title='Add Subscription'>
        @slot('body')
            <form wire:submit.prevent="save">

                <div class="grid grid-cols-2 gap-x-2 gap-y-5">
                    <div class="col-span-2">
                        @if (session()->has('message'))
                            <div class="w-full py-2 px-2 bg-green-200 rounded">
                                <span class="text-green-900">{{ session('message') }}</span>
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="w-full py-2 bg-red-200 rounded">
                                <span class="text-red-400">{{ session('error') }}</span>
                            </div>
                        @endif
                    </div>
                    <div>
                        <div class="relative w-full min-w-[200px] h-10">
                            <input
                                class="peer w-full h-full bg-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 border-t-transparent focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
                                placeholder=" " wire:model="subscription_number" />
                            <label
                                class="flex w-full h-full select-none pointer-events-none absolute left-0 font-normal !overflow-visible truncate peer-placeholder-shown:text-blue-gray-500 leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px] peer-focus:text-[11px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-gray-500 peer-focus:text-gray-900 before:border-blue-gray-200 peer-focus:before:!border-gray-900 after:border-blue-gray-200 peer-focus:after:!border-gray-900">
                                Subscription Number
                            </label>
                        </div>


                        @error('subscription_number')
                            <p class="text-red-500 text-xs italic mt-1"><i
                                    class="fas fa-exclamation-circle"></i></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <div class="relative w-full min-w-[200px] h-10">
                            <input
                                class="peer w-full h-full bg-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 border-t-transparent focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
                                placeholder=" " type="date" wire:model="starting_date" />
                            <label
                                class="flex w-full h-full select-none pointer-events-none absolute left-0 font-normal !overflow-visible truncate peer-placeholder-shown:text-blue-gray-500 leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px] peer-focus:text-[11px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-gray-500 peer-focus:text-gray-900 before:border-blue-gray-200 peer-focus:before:!border-gray-900 after:border-blue-gray-200 peer-focus:after:!border-gray-900">
                                Starting Date
                            </label>
                        </div>


                        @error('starting_date')
                            <p class="text-red-500 text-xs italic mt-1"><i
                                    class="fas fa-exclamation-circle"></i></i>{{ $message }}
                            </p>
                        @enderror
                    </div>


                    <div>
                        <div class="relative w-full min-w-[200px] h-10">
                            <select
                                class="peer w-full h-full bg-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 border-t-transparent focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
                                placeholder=" " wire:model="plan">
                                <option value="">Select Plan</option>
                                @foreach ($plans as $plan)
                                    <option value="{{$plan->subscriptionplan_id}}"> {{$plan->snplan_bandwidth. " Mbps"}}</option>
                                @endforeach

                            </select>
                            <label
                                class="flex w-full h-full select-none pointer-events-none absolute left-0 font-normal !overflow-visible truncate peer-placeholder-shown:text-blue-gray-500 leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px] peer-focus:text-[11px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-gray-500 peer-focus:text-gray-900 before:border-blue-gray-200 peer-focus:before:!border-gray-900 after:border-blue-gray-200 peer-focus:after:!border-gray-900">
                                Subscription Plan
                            </label>
                        </div>


                        @error('plan')
                            <p class="text-red-500 text-xs italic mt-1"><i
                                    class="fas fa-exclamation-circle"></i></i>{{ $message }}
                            </p>
                        @enderror
                    </div>



                    <div>
                        <div class="relative w-full min-w-[200px] h-10">
                            <select
                                class="peer w-full h-full bg-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 border-t-transparent focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
                                placeholder=" " wire:model="area">
                                <option value="">Select Area</option>
                                @foreach ($areas as $area)
                                    <option value="{{$area->subscriptionarea_id}}">{{ $area->snarea_name }}</option>

                                @endforeach
                            </select>
                            <label
                                class="flex w-full h-full select-none pointer-events-none absolute left-0 font-normal !overflow-visible truncate peer-placeholder-shown:text-blue-gray-500 leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px] peer-focus:text-[11px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-gray-500 peer-focus:text-gray-900 before:border-blue-gray-200 peer-focus:before:!border-gray-900 after:border-blue-gray-200 peer-focus:after:!border-gray-900">
                                Area Coverage
                            </label>
                        </div>


                        @error('area')
                            <p class="text-red-500 text-xs italic mt-1"><i
                                    class="fas fa-exclamation-circle"></i></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-2 col-span-2">
                        <button
                            class="rounded px-2 py-1 bg-blue-800 hover:bg-blue-600 text-white font-semibold">Add</button>
                        <button type="button" x-on:click="$dispatch('close-modal', {name:'create-user-modal'})"
                            class="rounded px-2 py-1  hover:bg-red-400 hover:text-white font-semibold transition-all delay-75">Cancel</button>
                    </div>

                </div>
            </form>
        @endslot
    </x-modal-form>


    <x-modal-form name="update-subscription-modal" title='Update Subscription'>
        @slot('body')
            <form wire:submit.prevent="update">

                <div class="grid grid-cols-2 gap-x-2 gap-y-5">
                    <div class="col-span-2">
                        @if (session()->has('message'))
                            <div class="w-full py-2 px-2 bg-green-200 rounded">
                                <span class="text-green-900">{{ session('message') }}</span>
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="w-full py-2 bg-red-200 rounded">
                                <span class="text-red-400">{{ session('error') }}</span>
                            </div>
                        @endif
                    </div>
                    <div>
                        <div class="relative w-full min-w-[200px] h-10">
                            <input
                                class="peer w-full h-full bg-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 border-t-transparent focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
                                placeholder=" " wire:model="subscription_number" />
                            <label
                                class="flex w-full h-full select-none pointer-events-none absolute left-0 font-normal !overflow-visible truncate peer-placeholder-shown:text-blue-gray-500 leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px] peer-focus:text-[11px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-gray-500 peer-focus:text-gray-900 before:border-blue-gray-200 peer-focus:before:!border-gray-900 after:border-blue-gray-200 peer-focus:after:!border-gray-900">
                                Subscription Number
                            </label>
                        </div>


                        @error('subscription_number')
                            <p class="text-red-500 text-xs italic mt-1"><i
                                    class="fas fa-exclamation-circle"></i></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <div class="relative w-full min-w-[200px] h-10">
                            <input
                                class="peer w-full h-full bg-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 border-t-transparent focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
                                placeholder=" " type="date" wire:model="starting_date" />
                            <label
                                class="flex w-full h-full select-none pointer-events-none absolute left-0 font-normal !overflow-visible truncate peer-placeholder-shown:text-blue-gray-500 leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px] peer-focus:text-[11px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-gray-500 peer-focus:text-gray-900 before:border-blue-gray-200 peer-focus:before:!border-gray-900 after:border-blue-gray-200 peer-focus:after:!border-gray-900">
                                Starting Date
                            </label>
                        </div>


                        @error('starting_date')
                            <p class="text-red-500 text-xs italic mt-1"><i
                                    class="fas fa-exclamation-circle"></i></i>{{ $message }}
                            </p>
                        @enderror
                    </div>


                    <div>
                        <div class="relative w-full min-w-[200px] h-10">
                            <select
                                class="peer w-full h-full bg-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 border-t-transparent focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
                                placeholder=" " wire:model="plan">
                                <option value="">Select Plan</option>
                                @foreach ($plans as $plan)
                                    <option value="{{$plan->subscriptionplan_id}}"> {{$plan->snplan_bandwidth. " Mbps"}}</option>
                                @endforeach

                            </select>
                            <label
                                class="flex w-full h-full select-none pointer-events-none absolute left-0 font-normal !overflow-visible truncate peer-placeholder-shown:text-blue-gray-500 leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px] peer-focus:text-[11px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-gray-500 peer-focus:text-gray-900 before:border-blue-gray-200 peer-focus:before:!border-gray-900 after:border-blue-gray-200 peer-focus:after:!border-gray-900">
                                Subscription Plan
                            </label>
                        </div>


                        @error('plan')
                            <p class="text-red-500 text-xs italic mt-1"><i
                                    class="fas fa-exclamation-circle"></i></i>{{ $message }}
                            </p>
                        @enderror
                    </div>



                    <div>
                        <div class="relative w-full min-w-[200px] h-10">
                            <select
                                class="peer w-full h-full bg-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 border-t-transparent focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
                                placeholder=" " wire:model="area">
                                <option value="">Select Area</option>
                                @foreach ($areas as $area)
                                    <option value="{{$area->subscriptionarea_id}}">{{ $area->snarea_name }}</option>

                                @endforeach
                            </select>
                            <label
                                class="flex w-full h-full select-none pointer-events-none absolute left-0 font-normal !overflow-visible truncate peer-placeholder-shown:text-blue-gray-500 leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px] peer-focus:text-[11px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-gray-500 peer-focus:text-gray-900 before:border-blue-gray-200 peer-focus:before:!border-gray-900 after:border-blue-gray-200 peer-focus:after:!border-gray-900">
                                Area Coverage
                            </label>
                        </div>


                        @error('area')
                            <p class="text-red-500 text-xs italic mt-1"><i
                                    class="fas fa-exclamation-circle"></i></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-2 col-span-2">
                        <button
                            class="rounded px-2 py-1 bg-blue-800 hover:bg-blue-600 text-white font-semibold">Update</button>
                        <button type="button" x-on:click="$dispatch('close-modal', {name:'create-user-modal'})"
                            class="rounded px-2 py-1  hover:bg-red-400 hover:text-white font-semibold transition-all delay-75">Cancel</button>
                    </div>

                </div>
            </form>
        @endslot
    </x-modal-form>
</div>
