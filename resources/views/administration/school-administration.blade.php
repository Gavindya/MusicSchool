@extends('layouts.app')

@section('title', 'School Administration')

@section('content')
    <div class="container"><h1>School Administration</h1></div>

    @include('courses.part-courses-details')

    @include('courses.part-courses-edit')

    @include('courses.part-courses-progress')
@stop