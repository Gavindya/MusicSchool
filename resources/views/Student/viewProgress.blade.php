@extends('templates.newMaster')

@section('style')

    <title>Stylish Search Box - Bootsnipp.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/searchBar.css">
    <link rel="stylesheet" href="app/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body, h1, h2, h3, h4, h5, h6 {
            font-family: "Montserrat", sans-serif
        }

        .w3-row-padding img {
            margin-bottom: 12px
        }

        /* Set the width of the sidenav to 120px */
        .w3-sidenav {
            width: 120px;
            background: #222;
        }

        /* Add a left margin to the "page content" that matches the width of the sidenav (120px) */
        #main {
            margin-left: 120px
        }

        /* Remove margins from "page content" on small screens */
        @media only screen and (max-width: 600px) {
            #main {
                margin-left: 0
            }
        }
    </style>
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
    Selected student is {{$id}}
    
    <div class="col-lg-6">
        <div class="container-fluid ">
            <div class="table-responsive ">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Student Id</th>
                        <th>Enroll Id</th>
                        <th>Assignment Id</th>
                        <th>Title</th>
                        <th>Score</th>

                    </tr>
                    </thead>
                    <tbody>

                    @for($i =0; $i < sizeof($studentprogress); $i++)

                        <tr>
                            <div>
                                <td class=>{{$studentprogress[$i]["student_id"]}}</td>
                                <td>{{$studentprogress[$i]["enrolment_id"]}}</td>
                                <td>{{$studentprogress[$i]["assignment_id"]}}</td>

                                <td>{{$studentprogress[$i]["assignment_tiltle"]}}</td>
                                <td>{{$studentprogress[$i]["score"]}}</td>


                            </div>

                        </tr>

                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
        <h2 class="w3-text-light-grey">My Name</h2>
        <hr style="width:200px" class="w3-opacity">
        <p>Some text about me. Some text about me. I am lorem ipsum consectetur adipiscing elit, sed do eiusmod tempor
            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
            laboris nisi ut aliquip
            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
            fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
            mollit anim id est laborum consectetur
            adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </p>
        <h3 class="w3-padding-16 w3-text-light-grey">My Skills</h3>
        <p class="w3-wide">Photography</p>
        <div class="w3-progress-container">
            <div class="w3-progressbar" style="width:95%"></div>
        </div>
        <p class="w3-wide">Web Design</p>
        <div class="w3-progress-container">
            <div class="w3-progressbar" style="width:85%"></div>
        </div>
        <p class="w3-wide">Photoshop</p>
        <div class="w3-progress-container">









@endsection