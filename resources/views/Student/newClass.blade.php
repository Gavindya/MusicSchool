@extends('templates.master')

@section('title')
    "Add Class"
@endsection

@section('style')

    <link rel="stylesheet" href="../../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../public/css/user1.css">
@endsection

@section('scripts')
    <script src="../../../public/js/jquery1.min.js"></script>
    <script src="../../../public/js/bootstrap.min.js"></script>
@endsection


@section('content')

    <h1>New Class</h1>
    <form action="/student/subscribe" method="POST">
        {{method_field('PATCH')}}
        <div class="form-group">
            <label for="studentname"><span class="req">* </span> Student Name: </label>

            <select class="form-control" name="student_id">
                <option value="">-- Select a student --</option>
                @for($i =0; $i < sizeof($namelist); $i++)


                    <option value="{{$i}}">{{$namelist[$i]}}</option>



                @endfor

            </select>


        </div>

        @include('Student.partials.new_class_form')



        {{csrf_field()}}
    </form>


@endsection