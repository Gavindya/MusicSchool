@extends('templates.newMaster')

@section('style')

    <title>Stylish Search Box - Bootsnipp.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/searchBar.css">
    <link rel="stylesheet" href="app/public/css/bootstrap.min.css">
@endsection


@section('script')
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/searchBar.css') }}"/>



@endsection
@section('headline')
    Student Management
@endsection
@section('content')

    <form action=/student/management/search method="post">
        {{method_field('PATCH')}}
        @include('Student.partials.searchBar')
        {{csrf_field()}}
    </form>
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
                                <td class=> {{$students[$i]['student_id']}}</td>
                                <td>
                                    <a href="/student/view/payment/{{$students[$i]['student_id']}}">{{$students[$i]['student_firstname']}}</a>
                                </td>
                                <td>
                                    <a href="/student/view/payment/{{$students[$i]['student_id']}}">{{$students[$i]['student_address']}}</a>
                                </td>
                                <td>
                                    <a href="/student/view/payment/{{$students[$i]['student_id']}}">{{$students[$i]['student_telephone']}}</a>
                                </td>
                                <td>
                                    <a href="/student/view/payment/{{$students[$i]['student_id']}}">{{$students[$i]['student_joindate']}}</a>
                                </td>

                            </div>

                        </tr>

                    @endfor
                    </tbody>
                </table>
            </div>
        </div>

    @endif



    <div class="col-lg-6">


    </div>
@endsection