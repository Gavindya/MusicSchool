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
    @include('templates.partials.searchbar')
    <div class="col-lg-6">


        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example
                <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">HTML</a></li>
                <li><a href="#">CSS</a></li>
                <li><a href="#">JavaScript</a></li>
                @for($i =0; $i < sizeof($students); $i++)


                    <li value="{{$i}}"><a
                                href="/student/view/payment/{{$students[$i]['id']}}">{{$students[$i]['name']}}</a></li>
                @endfor


            </ul>
        </div>

    </div>
@endsection