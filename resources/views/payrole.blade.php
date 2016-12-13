<!DOCTYPE html>
<html lang="en">
<?php
?>
<head>
    <title>Payroll</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .center {
            text-align: center;
            vertical-align: middle;
        }
        .pay {
            border: 0;
            outline: 0;
            background: transparent;
            border-bottom: 2px solid black;
            width: 160px;
        }
    </style>
    <script>
        jQuery(document).ready(function ($) {
            var monthNames = ["January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];
            var d = new Date();
            document.getElementById("month").innerHTML = monthNames[d.getMonth()];
            $('#selectAll').click(function (e) {
                $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
            });
        });
    </script>
</head>
<body>
<div class="container">
    <h1>Payroll</h1>
    <hr>
    <div>
        <table id="teacherTable" class="table table-hover table-responsive" border="1">
            <thead>
            <tr>
                <th class="center" width="10%"><input type="checkbox" id="selectAll"/>Paid</th>
                <th width="50%">Name</th>
                <th width="20%">Amount</th>
                <th width="20%">Date</th>
            </tr>
            </thead>
            <tbody>
            {{--@for($i =0; $i < sizeof($teachers); $i++)--}}
            @for($i =0; $i < 5; $i++)
                {{--<tr class="clickable-row" data-href="{{ route('teacherInfo',['id' => $teachers[$i]['id']])}}">--}}
                <tr class="clickable-row">
                    <td class="center"><input type="checkbox" name="query_myTextEditBox"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    {{--<td>{{$teachers[$i]['mobile']}}</td>--}}
                    {{--<td>{{$teachers[$i]['address']}}</td>--}}
                    {{--<td>{{$teachers[$i]['name']}}</td>--}}
                </tr>
            @endfor
            </tbody>
        </table>
        <br>
        <a href="#" type="button" class="btn btn-primary pull-right">Pay</a>
        <br>
        <hr>
        <div class="container">
            <h3>Total Payment for <span id="month"></span>&nbsp;&nbsp;&nbsp;
                <input class="pay" type="text" placeholder="Total Payment" readonly></h3>

        </div>
    </div>
</div>
</body>
</html>