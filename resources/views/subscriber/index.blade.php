@extends('layouts.app')

@section('title', 'Subscriber Information')

@section('content')


    <div class="flex justify-between p-2 w-full ">

        @livewire('subscriber.table-subscriber')

    </div>


@endsection
