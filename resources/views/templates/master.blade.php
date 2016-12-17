<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="../../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../public/css/user.css">
    <link rel="stylesheet" href="assets/bootstrap/fonts/font-awesome.min.css">
    <script src="../../../public/js/jquery.min.js"></script>
    <script src="../../../public/js/bootstrap.min.js"></script>


    @yield('style')

    @yield('scripts')


</head>

<body>


<div>
    @include('templates.partials.navbar')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    @include('templates.partials.sidepanel')
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">

                    @yield('firstSection')
                </div>
            </div>
            <div class="col-lg-offset-1 col-md-offset-1">


                @yield('content')

            </div>
        </div>
    </section>


    @yield('blackquote')

    @yield('features')

    @include('templates.partials.footer')
</div>
</body>


</html>