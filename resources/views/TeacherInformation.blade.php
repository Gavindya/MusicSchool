<!DOCTYPE html>
<html lang="en">
<?php
echo $teacher[0];
echo "*************";
echo $teacher[1];
echo "*************";
echo $teacher[2][0];
echo "**";
echo $teacher[2][1];
echo "**";
echo $teacher[2][2];
echo "**";
echo $teacher[2][3];
echo "*************";
echo $teacher[3][0];
echo "**";
echo $teacher[3][1];
echo "**";
echo $teacher[3][2];
echo "**";
echo $teacher[3][3];
echo "**";
echo $teacher[3][4];
echo "**";
echo $teacher[3][5];
echo "*************";

?>
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
            $("#togglePT").click(function () {
                $("#paymentsTable").toggle();

            });
            $("#toggleClsTbl").click(function () {
                $("#classesTable").toggle();

            });

        });

        function edit() {
            var eTP = document.getElementById("telephone");
            eTP.removeAttribute('readonly');
            var eMN = document.getElementById("mobile");
            eMN.removeAttribute('readonly');
            var eAD = document.getElementById("address");
            eAD.removeAttribute('readonly');
            var eINS = document.getElementById("instruments");
            eINS.removeAttribute('readonly');
            var eUPDT = document.getElementById("update");
            eUPDT.removeAttribute('disabled');
        }

    </script>

</head>
<body>
<div class="container">
    <h1>Teacher Management</h1>
    <hr style="margin: 0">
    <h2>Personal Details</h2>
    <div id="form" class="row">
        <form method="post" action="/updateTeacher">
            {{--for no this is GET. it should be PATCH--}}
            {{--{{method_field('PATCH')}}--}}
            {{method_field('PATCH')}}
            <div class="col-lg-4 col-md-4">
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" id="id" placeholder="ID" readonly name="id"
                           value={{$teacher[0]}}>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" readonly value={{$teacher[1]}}>
                </div>
                <div class="form-group">
                    <label for="instruments">Instruments</label>
                    <input type="text" class="form-control" id="instruments" name="instruments" readonly
                           value={{$teacher[0]}}>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" readonly
                           value={{$teacher[0]}}>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="password" name="password" readonly
                           value={{$teacher[0]}}>
                </div>
                <div class="form-group">
                    <label for="re-password">Re-Enter Password</label>
                    <input type="text" class="form-control" id="re-password" name="re-password" readonly
                           value={{$teacher[0]}}>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="form-group">
                    <label for="telephone">Telephone Number</label>
                    <input type="text" class="form-control" id="telephone" placeholder="Telephone Number"
                           name="telephone" readonly value={{$teacher[0]}}>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" readonly value={{$teacher[0]}}>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" readonly value={{$teacher[0]}}>
                </div>
            </div>
            <div class="form-group container-fluid pull-left">
                <a id="update" disabled href="{{ route('updateTeacherInfo',['id' => $teacher[0]]) }}" type="button"
                   class="btn btn-primary">Update</a>
            </div>
            {{csrf_field()}}
        </form>

        <div class="pull-right container-fluid">
            <input type="button" id="edit" onclick="edit()" value="Edit" class="btn-primary btn"/>
            {{--FOR NOW REDIRECTS TO PAYROLE> SHOULD BE FUNCTION FOR RESIGN--}}
            <a href="{{ route('salaryController') }}" type="button" class="btn btn-primary">Resign</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-6 pull-left">
            <h3 style="margin: 0">Classes Assigned</h3>
        </div>
        <div class="container-fluid pull-right">
            <button id="toggleClsTbl" class="btn-primary btn glyphicon glyphicon-collapse-down"></button>
        </div>
    </div>
    <div id="myClasses">
        <table id="classesTable" class="table table-hover table-responsive" style="display:none;">
            <thead>
            <tr>
                <th>Instrument</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @for($i =0; $i < sizeof($teacher[3]) ; $i++)
                <tr class="clickable-row">
                    <td>{{$teacher[3][2]}}</td>
                    <td>{{$teacher[3][0]}}</td>
                    <td>{{$teacher[3][4]}}</td>
                    <td>{{$teacher[3][5]}}</td>
                    <td>{{$teacher[3][3]}}</td>
                </tr>
            @endfor
            {{--{{$teachers->links()}}--}}
            </tbody>
        </table>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-6 pull-left">
            <h3 style="margin: 0">Payments History</h3>
        </div>
        <div class="container-fluid pull-right">
            <button id="togglePT" class="btn-primary btn glyphicon glyphicon-collapse-down"></button>
        </div>
    </div>
    <div id="myPayments">
        <table id="paymentsTable" class="table table-hover table-responsive" style="display:none;">
            <thead>
            <tr>
                <th>Payment Date</th>
                <th>Amount</th>
                <th>Worked Hours</th>
                <th>Worked Dates</th>
            </tr>
            </thead>
            <tbody>
            @for($i =0; $i < sizeof($teacher[2]) ; $i++)
                <tr class="clickable-row">
                    <td>{{$teacher[2][3]}}</td>
                    <td>{{$teacher[2][2]}}</td>
                    <td>{{$teacher[2][0]}}</td>
                </tr>
            @endfor
            {{--{{$teachers->links()}}--}}
            </tbody>
        </table>
    </div>
</div>
</body>
</html>