@extends('layouts.app')

@section('title', 'Attendance Mark')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@stop

@section('content')
    <div class="container"><h1>Mark Attendance
            @if(isset($courseId))
                : {{$courseId}}
            @endif
        </h1>
    </div>

    @include('attendance.attendance-mark-selectclass')
    @if(Session::has('randilsmsg'))
        <p class="alert alert-info">{{ Session::get('randilsmsg') }}
    @endif
    @include('attendance.attendance-studentlist')
@stop