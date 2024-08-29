@extends('layouts.app')

@section('title', 'Announcement')

@section('content')
@livewire('announcement.create-announcement')


@livewire('announcement.table-announcement')

@endsection
