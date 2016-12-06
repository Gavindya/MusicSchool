@extends('templates.master')

@section('title')
    "New Teacher"
@endsection
@section('style')

    <link rel="stylesheet" href="../../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../public/css/user1.css">
@endsection
@section('scripts')
    <script src="../../../public/js/jquery1.min.js"></script>
    <script src="../../../public/js/bootstrap.min.js"></script>
@endsection


@section('firstSection')
    <h1>New Teacher</h1>
    <form action="/teacher/enroll" method="POST">
        {{method_field('PATCH')}}
        @include('Teacher.partials.teacher_form')
        {{csrf_field()}}
    </form>


@endsection
