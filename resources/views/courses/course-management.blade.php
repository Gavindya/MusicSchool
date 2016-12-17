@extends('layouts.app')

@section('title', 'Course Management')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@stop

@section('content')
    <div class="container"><h1>Course Management</h1></div>

    @include('courses.part-courses-all')

    @include('courses.part-courses-add')

@stop