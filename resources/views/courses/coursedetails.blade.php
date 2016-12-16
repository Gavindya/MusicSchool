@extends('layouts.master')

@section('title', 'Course Details')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@stop

@section('content')
    <h1>Course Details</h1>
    <h2>{{$course['course_id']}}</h2>
@stop