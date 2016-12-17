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
            arr = [];
            $("input:checkbox[name=selected[]]:checked").each(function(){
                arr.push($(this).val());
            })
            document.getElementById("ids").value = arr;
        });
    </script>
</head>
<body>
<div class="container">
    <h1>Payroll</h1>
    <hr>
    {{--<a href="{{route('generate')}}">Generate Salary</a>--}}
    <div>
        <div id="msgArea">
            @if(Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}
                    <button id="m" class="glyphicon glyphicon-remove pull-right"></button></p>
            @endif
            @if(Session::has('paid'))
                <p class="alert alert-success">{{ Session::get('paid') }}
                    <button id="p" class="glyphicon glyphicon-remove pull-right"></button></p>
                @endif
            @if(Session::has('error'))
                <p class="alert alert-danger">{{ Session::get('error') }}
                    <button id="e" class="glyphicon glyphicon-remove pull-right"></button></p>
                @endif
        </div>
        <form method="post" action="/payTeachers">
            {{method_field('PATCH')}}
            <div class="form-group">
                <table id="teacherTable" class="table table-hover table-responsive" border="1">
                    <thead>
                    <tr>
                        <th class="center" width="10%"><input type="checkbox" id="selectAll"/>Paid</th>
                        <th width="50%">Name</th>
                        <th width="20%">Amount</th>
                        <th width="20%">Generated Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i =0; $i < sizeof($payments); $i++)
                        <tr>
                            <td class="center"><input type="checkbox" name="selected[]" value="{{$payments[$i]['payment_id']}}">{{$payments[$i]['payment_id']}}</td>
                            <td>{{$payments[$i]['teacher_name']}}</td>
                            <td>{{$payments[$i]['amount']}}</td>
                            <td>{{$payments[$i]['generated_date']}}</td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <input type="hidden" name="paymentWindow" value="{{$paymentWinType}}">
            </div>
            <br>
            <div class="form-group">
                <button class="btn-primary" type="submit">PAY</button>
            </div>
            {{csrf_field()}}
        </form>
        <br>
        <hr>
        <div class="container">
            <h3>Total Payment for <span id="month"></span>&nbsp;&nbsp;&nbsp;
                <input class="pay" type="text" placeholder="Total Payment" readonly value="{{$tot}}"></h3>
        </div>
    </div>
</div>
</body>
</html>