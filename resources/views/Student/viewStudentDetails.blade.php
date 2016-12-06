@extends('templates.master')

@section('title')
    "Enroll Student"
@endsection
@section('style')

    <link rel="stylesheet" href="../../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../public/css/user1.css">
@endsection
@section('scripts')
    <script src="../../../public/js/jquery1.min.js"></script>
    <script src="../../../public/js/bootstrap.min.js"></script>
@endsection


@section('content')

    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>

                @for($i =0; $i < sizeof($students); $i++)

                    <tr>
                        <div
                        <td>{{$students[$i]['id']}}</td>
                        <td>{{$students[$i]['name']}}</td>

                    </tr>

                @endfor
                </tbody>
            </table>
        </div>
    </div>
@endsection





