<!DOCTYPE html>
<html lang="en">
<?php
//echo var_dump($instruments); ?>
<head>
    <title>Teacher Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".clickable-row").click(function () {
                window.document.location = $(this).data("href");
            });
        });
    </script>
</head>
<body>
<div class="container">
    <h1>Teacher Management</h1>
    <hr>
    <h2>Current Staff</h2>
    <div id="myTable">
        <table id="teachersTable" class="table table-hover table-responsive">
            <thead>
            <tr>
                <th width="10%">ID</th>
                <th width="30%">Name</th>
                <th width="10%">Telephone</th>
                <th width="30%">Address</th>
                <th width="20%">Joined Date</th>
            </tr>
            </thead>
            <tbody>
            @for($i =0; $i < sizeof($teachers); $i++)
            <tr class="clickable-row" data-href="{{ route('teacherInfo',['id' => $teachers[$i]['teacher_id']])}}">
                <td>{{$teachers[$i]['teacher_id']}}</td>
                <td>{{$teachers[$i]['teacher_name']}}</td>
                <td>{{$teachers[$i]['teacher_telephone']}}</td>
                <td>{{$teachers[$i]['teacher_address']}}</td>
                <td>{{$teachers[$i]['teacher_joindate']}}</td>
            </tr>
            @endfor
            {{$teachers->links()}}
            </tbody>
        </table>
    </div>
</div>
<div class="container">
    <h2>Add New Teacher</h2>
    <hr>
    <form method="post" action="/addTeacher">
        {{method_field('PATCH')}}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" placeholder="Address" name="address">
        </div>
        <div class="form-group">
            <label for="telephone">Telephone</label>
            <input type="text" class="form-control" id="telephone" placeholder="Telephone" name="telephone">
        </div>
        <label>Instruments</label>
        <div class="container">
            @for($i =0; $i < sizeof($instruments); $i++)
            <div class="checkbox">
                <label><input type="checkbox" value="">{{$instruments[$i]['instrument_name']}}</label>
            </div>
            @endfor
        </div>

        <div class="form-group">
            <button type="submit">Add teacher</button>
        </div>
        {{csrf_field()}}
    </form>

    <hr>
    <a href="{{ route('salaryController') }}" type="button" class="btn btn-primary">Payrole</a>
</div>
</body>
</html>