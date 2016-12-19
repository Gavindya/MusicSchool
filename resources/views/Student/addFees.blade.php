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
    Add Fees
@endsection
@section('content')
    @if (Session::has('msg'))
        <div class="alert alert-success">{{ Session::get('msg') }}</div>
    @endif

    <form action=/student/fees/search method="post">
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
                                <td class=> {{$students[$i]['id']}}</td>
                                <td><a href="/student/fees/{{$students[$i]['id']}}">{{$students[$i]['name']}}</a></td>
                                <td><a href="/student/fees/{{$students[$i]['id']}}">{{$students[$i]['address']}}</a>
                                </td>
                                <td><a href="/student/fees/{{$students[$i]['id']}}">{{$students[$i]['telephone']}}</a>
                                </td>
                                <td><a href="/student/fees/{{$students[$i]['id']}}">{{$students[$i]['created_at']}}</a>
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