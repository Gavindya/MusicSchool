@extends('layouts.app')

@section('title', 'Course Details')

@section('content')
    <div class="container"><h1>Course Details - {{$course->course_name}}</h1></div>

    @include('courses.part-courses-details')

    @include('courses.part-courses-edit')

    @include('courses.part-courses-progress')
@stop