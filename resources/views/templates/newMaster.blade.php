<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MusicSchool</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/user.css">


    @yield('style')

    @yield('script')
</head>

<body>
<div class="container">
    <div class="row">
        <h1 class="col-lg-offset-4">@yield('headline')</h1>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            @yield('sidepanel')
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