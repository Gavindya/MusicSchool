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

@endsection

@section('headline')
    Student Management
@endsection
@section('content')

    <div class="dropdown ">
        <button class="btn btn-default dropdown-toggle col-lg-5" data-toggle="dropdown" aria-expanded="false"
                type="button" name="student-id">Select a student <span class="caret"></span></button>
        <ul class="dropdown-menu col-lg-5" role="menu" name="student">
            <li><a href="#">First Item</a></li>
            <li><a href="#">Second Item</a></li>
            <li><a href="#">Third Item</a></li>
            @for($i =0; $i < sizeof($students); $i++)


                <li value="{{$i}}"><a href="/student/view/payment/{{$students[$i]['id']}}">{{$students[$i]['name']}}</a>
                </li>
            @endfor
        </ul>
        ]

    </div>







@endsection