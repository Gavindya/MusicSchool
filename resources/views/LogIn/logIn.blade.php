<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="{{ URL::asset('css/LogIn.css') }}"/>
<script type="text/javascript" src="{{ URL::asset('js/LogIn.js') }}"></script>
</head>

<body>
<div class="login-page">
    <div class="form">

        <form class="login-form" method="post" action="/login/user">
            {{method_field('PATCH')}}
            <input type="number" name="index" placeholder="index"/>
            <input type="password" name=password placeholder="password"/>
            <button>login</button>
            <p class="message">Not registered? <a href="#">Create an account</a></p>
            {{csrf_field()}}
        </form>
    </div>
</div>
</body>
</html>