@extends('layouts.master')

@section('title', 'Course Management')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@stop

@section('content')
    <h1>Course Management</h1>

    @include('courses.part-currentcourses')

    @include('courses.part-addcourse')

@stop