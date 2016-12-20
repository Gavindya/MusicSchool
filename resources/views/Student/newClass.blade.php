@extends('templates.newMaster')

@section('style')

    <title>Stylish Search Box - Bootsnipp.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/searchBar.css">
    <link rel="stylesheet" href="app/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/searchBar.css') }}"/>
@endsection


@section('script')
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>


@endsection
@section('headline')
    New Class
@endsection

@section('content')

    <form action=/class/search/students method="post">
        {{method_field('PATCH')}}

        {{csrf_field()}}
    </form>

    <div class="row">
        @if (Session::has('msg'))
            <div class="alert alert-success">{{ Session::get('msg') }}</div>
        @endif
        @if(count($errors))
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        @if($search==1)

            <div class="container-fluid ">
                <div class="table-responsive ">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Telephone</th>
                            <th>Admission Date</th>

                        </tr>
                        </thead>
                        <tbody>

                        @for($i =0; $i < sizeof($students); $i++)

                            <tr>
                                <div>
                                    <td class=>
                                        <button href="/adddata/newClass">{{$students[$i]['student_id']}}</button>
                                    </td>
                                    <td>{{$students[$i]['student_name']}}</td>
                                    <td>{{$students[$i]['student_address']}}</td>
                                    <td>{{$students[$i]['student_telephone']}}</td>
                                    <td>{{$students[$i]['student_joindate']}}</td>

                                </div>


                            </tr>

                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>

        @endif
        <div class="col-lg-6">

            <form action=/student/subscribe method="POST">


                <div class="form-group">
                    <label for="studentname"><span class="req">* </span> Student Name: </label>

                    <select class="form-control" name="student_id">
                        <option value="">-- Select a student --</option>
                        @for($i =0; $i < sizeof($students); $i++)


                            <option value="{{$students[$i]['student_id']}}">{{$students[$i]['student_firstname']}}</option>



                        @endfor

                    </select>


                </div>

                @include('Student.partials.new_class_form')



                {{csrf_field()}}
            </form>

        </div>
    </div>
@endsection