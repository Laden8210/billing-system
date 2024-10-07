@extends('layouts.app')

@section('title', 'Report')

@section('content')

<h1 class="font-bold my-2">Reports</h1>

<div class="flex justify-between">
    <h2 class="font-bold my-2">Select Report</h2>


    <div class="w-1/2 mx-2 flex justify-end">

        <div class="w-1/2 mx-2">
            <label for="">Area</label>
            <select name="" id="" class="p-2 outline-none border border-slate-300 w-full">
                <option value="">Tupi</option>
                <option value="">Koronadal</option>

            </select>
        </div>

        <div class="w-1/2 ">
            <br>
            
            <div class="bg-cyan-400 rounded-full px-2 py-1 text-slate-50 flex justify-normal">
                <i class="far fa-calendar mt-1 mx-2"></i>
                <p>Currently viewing: Jul 5, 2024</p>
            </div>
        </div>

    </div>
</div>


<div class="grid grid-rows-3 grid-flow-col gap-5 p-2">

    <a href="{{route('remittanceReport')}}" class="bg-green-500 hover:bg-green-600 text-center p-10 text-xl text-white">Remittance Report</a>
    <a href="{{ route('paymentReport') }}"  target="_blank" class="bg-green-500 hover:bg-green-600 text-center p-10 text-xl text-white">Payment History</a>
    <a href="{{ route('subscriberReport') }}"  target="_blank" class="bg-green-500 hover:bg-green-600 text-center p-10 text-xl text-white">Subscriber Report</a>
    <a href="{{ route('billingreport') }}"  target="_blank" class="bg-green-500 hover:bg-green-600 text-center p-10 text-xl text-white">Billing Report</a>
    <a href="{{ route('announcementreport') }}"  target="_blank" class="bg-green-500 hover:bg-green-600 text-center p-10 text-xl text-white">Announcement Report</a>

</div>






@endsection
