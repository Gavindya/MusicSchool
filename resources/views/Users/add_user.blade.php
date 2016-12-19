@extends('templates.newMaster')
@section('style')

    <link rel="stylesheet" href="{{ URL::asset('css/add_user_form.css') }}"/>
@endsection

@section('headline')



@endsection



@section('content')

    <div class="container">
        <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please sign up for Bootsnipp
                            <small>It's free!</small>
                        </h3>


                        @if (Session::has('msg'))
                            <div class="alert alert-success">{{ Session::get('msg') }}</div>
                        @endif
                        @if(count($errors))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                    </div>
                    <div class="panel-body">

                        <form role="form" action="/user/add/store" method="POST">
                            {{csrf_field()}}
                            @include('Users.partials.add_user_form')
                            {{csrf_field()}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection