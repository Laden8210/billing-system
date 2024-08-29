@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')


    <div class="grid grid-cols-2 justify-between p-2 ">

        <div class="">

            @livewire('service.create-service')
            @livewire('service.table-service')


        </div>

        <div class="border border-l p-2">

                @livewire('service.create-coverage')
                @livewire('service.table-coverage')
        </div>

    </div>


@endsection
