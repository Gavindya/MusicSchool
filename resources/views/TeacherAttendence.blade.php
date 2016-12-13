<!DOCTYPE html>
<html lang="en">
<?php

?>
<head>
    <title>Teacher Attendance</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        table.tableSection {
            display: table;
            width: 100%;
        }
        table.tableSection thead, table.tableSection tbody {
            float: left;
            width: 100%;
        }
        table.tableSection tbody {
            overflow: auto;
            height: 300px;
        }
        table.tableSection tr {
            width: 100%;
            display: table;
            text-align: left;
        }
        table.tableSection th, table.tableSection td {
            width: 50%;
        }
    </style>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".clickable-row").click(function () {
                window.document.location = $(this).data("href");
//                var $row = $(this).closest("tr");    // Find the row
//                var $selectedID = $row.find(".nrId").text(); // Find the text
//                $("#id").val($selectedID);
//                var $selectedName = $row.find(".nrName").text();
//                $("#name").val($selectedName);
            });

            var dt = new Date();
            var todayDate = (dt.getFullYear()) + "." + (("0" + (dt.getMonth() + 1)).slice(-2)) + "." + (("0" + dt.getDate()).slice(-2));
            document.getElementById("day").value = todayDate;
            document.getElementById("date").innerHTML = todayDate;
            document.getElementById("time").innerHTML = (("0" + dt.getHours()).slice(-2)) + ":" + (("0" + dt.getMinutes()).slice(-2));

            var $rows = $('#teachersTable tr');
            $('#search').keyup(function () {
                var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
                $rows.show().filter(function () {
                    var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                    return !~text.indexOf(val);
                }).hide();
            });
        })

    </script>

</head>
<body>
<div class="row">
    <div class="container">
        <h2>Date: <span id="date"></span></h2>
        <h3>Time: <span id="time"></span></h3>
        <hr>
        <h2>Staff</h2>
        <div class="col-lg-5 col-sm-5 col-xs-5">
            <span class="glyphicon glyphicon-search"></span>
            <input type="text" id="search" placeholder="Enter Name Or ID">
            <hr>
            <table id="teachersTable" class="table table-bordered table-hover table-responsive tableSection">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                @for($i =0; $i < sizeof($teachers); $i++)
                    <tr class="clickable-row"
                        data-href="{{ route('attendence',['id' => $teachers[$i]['teacher_id']])}}">
                        <td class="nrId">{{$teachers[$i]['teacher_id']}}</td>
                        <td class="nrName">{{$teachers[$i]['teacher_name']}}</td>
                </tr>
                @endfor
                </tbody>

            </table>
        </div>
        <div class="col-lg-5 col-sm-5 col-xs-5">
            <form method="post" action="/markAttenedence">
                {{method_field('PATCH')}}
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" id="id" placeholder="ID" name="id" readonly
                           value={{$teacher[0]}}>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" readonly
                           value={{$teacher[1]}}>
                </div>
                <div class="form-group">
                    <label for="day">Date</label>
                    <input type="text" class="form-control" id="day" name="day" placeholder="Date" readonly>
                </div>
                <div class="form-group">
                    <label for="arrive">Arrival Time</label>
                    <input type="time" id="arrive" name="arrive" value={{$teacherRecord[2]}}>
                    {{--<input type="text" class="form-control" id="arrive" placeholder="Arrival Time" name="arrive" value={{$teacherRecord[2]}}>--}}
                </div>
                <div class="form-group">
                    <label for="depart">Departure Time</label>
                    <input type="time" id="depart" name="depart" value={{$teacherRecord[3]}}>
                    {{--<input type="text" class="form-control" id="depart" placeholder="Arrival Time" name="depart" value={{$teacherRecord[3]}}>--}}

                </div>
                <div class="form-group">
                    <button type="submit">Save</button>
                </div>
                <div class="form-group">
                    <button type="reset">Cancel</button>
                </div>
                {{csrf_field()}}
            </form>
        </div>
    </div>
</div>
</body>
</html>