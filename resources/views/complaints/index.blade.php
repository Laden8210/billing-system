@extends('layouts.app')

@section('title', 'Complaints')

@section('content')

@livewire('complaints.create-complaints')

@livewire('complaints.table-complaints')

@endsection
