@extends('layouts.master')

@section('title', 'Course Management')

@section('sidebar')
    @parent
    <p>This is appended to the master sidebar.</p>
@stop

@section('content')
    <h1>Course Management</h1>
    <h2>Current Courses</h2>

    <div class="container">
        <table class="table table-hover table-responsive">
            <thead>
            <tr>
                <th width="10%">ID</th>
                <th width="20%">Instrument</th>
                <th width="10%">Weekday</th>
                <th width="20%">Start Time</th>
                <th width="20%">End Time</th>
                <th width="20%">Teacher</th>
            </tr>
            </thead>
            <tbody>
            @foreach($courses as $course)
                <tr onclick="window.location='/courses/{{$course['course_id']}}/details';">
                    <td>{{$course['course_id']}}</td>
                    <td>{{$course['instrument_id']}}</td>
                    <td>{{$course['course_id']}}</td>
                    <td>{{$course['weekday']}}</td>
                    <td>{{$course['timeslot_id']}}</td>
                    <td>{{$course['timeslot_id']}}</td>
                    <td>{{$course['teacher_id']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <h2>Add Course</h2>
        <p>Click on the button below to add a new course.</p>
        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Add course</button>
        <div id="demo" class="collapse">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </div>
    </div>

@stop