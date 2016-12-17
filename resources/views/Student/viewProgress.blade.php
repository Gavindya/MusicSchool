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
    Student Progress
@endsection
@section('content')
    <div class="col-lg-6">
        <div class="container-fluid ">
            <div class="table-responsive ">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Enroll Id</th>
                        <th>grade</th>
                        <th>remarks</th>

                    </tr>
                    </thead>
                    <tbody>

                    @for($i =0; $i < sizeof($studentprogress); $i++)

                        <tr>
                            <div>
                                <td class=>{{$studentprogress[$i]['id']}}</td>
                                <td>{{$studentprogress[$i]['enroll_id']}}</td>
                                <td>{{$studentprogress[$i]['grade']}}</td>
                                <td>{{$studentprogress[$i]['remarks']}}</td>


                            </div>

                        </tr>

                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>









@endsection