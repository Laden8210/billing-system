@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="p-2">
        <div class="flex justify-between p-2">

            <div>
                <h2 class="font-bold text-xl">Overview</h2>
            </div>

            <div class="">
                <input type="date" class="w-full p-2 bg-cyan-600 rounded-full text-white text-xs outline-none shadow-sm ">
            </div>

        </div>

        <div class="grid grid-cols-3 w-full my-2 gap-5 items-center">
            <div class="shadow rounded p-5 ">
                <h3 class="font-bold">Revenue</h3>
                <div class="flex justify-between my-5 text-5xl">
                    <h1 class="font-bold">Php. {{ $revenue }}</h1>
                    <i class="fa fa-edit"></i>
                </div>

            </div>

            <div class="shadow rounded p-5">
                <h3 class="font-bold">Outstanding Bill</h3>
                <div class="flex justify-between my-5 text-5xl">
                    <h1 class=" font-bold">{{ $outstandingBill }}</h1>
                    <i class="fa fa-edit"></i>
                </div>

            </div>

            <div class=" shadow rounded p-5">
                <h3 class="font-bold">Subscriber</h3>
                <div class="flex justify-between my-5 text-5xl">
                    <h1 class=" font-bold">{{ $subscriberCount }}</h1>
                    <i class="fa fa-edit"></i>
                </div>

            </div>

            <div class=" shadow rounded p-5">
                <h3 class="font-bold">Total Remittance</h3>
                <div class="flex justify-between my-5 text-5xl">
                    <h1 class="font-bold">₱{{ number_format($remittance, 2) }}</h1>

                    <i class="fa fa-edit"></i>
                </div>

            </div>
        </div>


        <div class="col-span-3 rounded shadow mx-10 p-2">
            <h2>New Subscriber Subscription</h2>
            <h1 class="text-5xl font-bold">{{ $newSubscriptionCount }}</h1>
            <table class="w-full table-auto border-collapse border border-slate-400 rounded my-2">
                <thead>
                    <tr class="bg-slate-200">
                        <th class="border border-slate-300 px-2 py-4">FULLNAME</th>
                        <th class="border border-slate-300 px-2 py-4">AREA</th>
                        <th class="border border-slate-300 px-2 py-4">SUBSCRIPTION PLAN</th>
                        <th class="border border-slate-300 px-2 py-4">DATE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscribers as $subscriber)
                        <tr class="text-center">
                            <td class="border border-slate-300 p-2">
                                {{ $subscriber->sr_fname . ' ' . $subscriber->sr_lname }}</td>
                            <td class="border border-slate-300 p-2">
                                {{ $subscriber->sr_street . ' ' . $subscriber->sr_city . ' ' . $subscriber->sr_province }}
                            </td>
                            <td class="border border-slate-300 p-2">
                                {{ $subscriber->subscriptions->first()->snplan_bandwidth ?? 'N/A' }}</td>
                            <!-- Assuming snplan_name exists -->
                            <td class="border border-slate-300 p-2">{{ $subscriber->created_at->format('Y-m-d') }}
                            </td> <!-- Assuming created_at is available -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



    </div>
    </div>


@endsection
