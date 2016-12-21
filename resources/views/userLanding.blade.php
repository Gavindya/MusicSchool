<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music School</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/simple-sidebar.css') }}"/>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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


    @yield('style')

    @yield('script')
</head>

<body>
<div class="container">
    <div class="row">
        <h1 class="col-lg-offset-4">@yield('headline')</h1>
        <a href="{{route('logoutUser')}}" class="btn-primary btn">Logout</a>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            @include('teacherSide')
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
            @yield('content')
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @yield('footer')
    </div>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>