@extends('layouts.app')

@section('title', 'Attendance Mark')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@stop

@section('content')
    <div class="container"><h1>Mark Attendance</h1></div>

    @include('attendance.part-attendance-select-class')

    @include('attendance.part-attendance-details')
@stop