@extends('layouts.app')

@section('title', 'Attendance View')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@stop

@section('content')
    <div class="container"><h1>Student Attendance</h1></div>

    @include('attendance.part-attendance-select-student')

    @include('attendance.part-attendance-details-student')
@stop