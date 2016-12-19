<!DOCTYPE html>
<html lang="en">
<?php
?>
<head>
    <title>Payroll Summary</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .pay {
            border: 0;
            outline: 0;
            background: transparent;
            border-bottom: 2px solid black;
            width: 150px;
        }
    </style>
    <script>
        jQuery(document).ready(function ($) {
            var monthNames = ["January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];
            var d = new Date();
            document.getElementById("year").innerHTML = String(d.getFullYear());
            document.getElementById("month").innerHTML = monthNames[d.getMonth()];
            document.getElementById("month2").innerHTML = monthNames[d.getMonth()];
            document.getElementById("date").innerHTML = String(d.getDate());
        });
    </script>
</head>
<body>
<div class="container">
    <h1>Payroll Summary</h1>
    <h2><span id="year"></span>-<span id="month"></span>-<span id="date"></span></h2>
    <hr>
        <div>
            @if(Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}
                    <button id="m" class="glyphicon glyphicon-remove pull-right"></button></p>
            @endif
        </div>
        <form>
            <div class="form-group">
                <table id="teacherTable" class="table table-hover table-responsive" border="1">
                    <thead>
                    <tr>
                        <th width="5%">P_ID</th>
                        <th width="30%">Name</th>
                        <th width="25%">Amount</th>
                        <th width="20%">Generated Date</th>
                        <th width="20%">Paid Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i =0; $i < sizeof($payments); $i++)
                        <tr>
                            <td>{{$payments[$i]['payment_id']}}</td>
                            <td>{{$payments[$i]['teacher_name']}}</td>
                            <td>{{$payments[$i]['amount']}}</td>
                            <td>{{$payments[$i]['generated_date']}}</td>
                            <td>{{$payments[$i]['paid_date']}}</td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </form>
        <div class="container">
            <h3>Total Payment for <span id="month2"></span>&nbsp;&nbsp;
                <input class="pay" type="text" placeholder="Total Payment" readonly value="{{$tot}}"></h3>
        </div>
    </div>
</div>
</body>
</html>