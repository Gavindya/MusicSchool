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
            @foreach($teachers as $teacher)
            <tr class="clickable-row" data-href="{{ route('teacherInfo',['id' => $teacher['teacher_id']])}}">
                <td>{{$teacher['teacher_id']}}</td>
                <td>{{$teacher['teacher_name']}}</td>
                <td>{{$teacher['teacher_telephone']}}</td>
                <td>{{$teacher['teacher_address']}}</td>
                <td>{{$teacher['teacher_joindate']}}</td>
            </tr>
            @endforeach
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
            <input type="text" class="form-control" id="name" name="name" pattern="[A-Za-z].{2,}" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" placeholder="Address" name="address" pattern=".{3,}" required>
        </div>
        <div class="form-group">
            <label for="telephone">Telephone (format: 0xxxxxxxx):</label>
            <input type="tel" class="form-control" id="telephone" placeholder="Telephone" name="telephone" pattern="^\d{10}$" required >
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
