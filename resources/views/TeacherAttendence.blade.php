<!DOCTYPE html>
<html lang="en">
<?php
//echo var_dump($teachers); ?>
<head>
    <title>Teacher Management</title>
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
                var $row = $(this).closest("tr");    // Find the row
                var $selectedID = $row.find(".nrId").text(); // Find the text
                var $selectedName = $row.find(".nrName").text();
                $("#id").val($selectedID);
                $("#name").val($selectedName);
            });
            document.getElementById("date").innerHTML = Date();

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
        <h1 id="date"></h1>
        <hr>
        <h2>Staff</h2>
        <div class="col-lg-5 col-sm-5 col-xs-5">

            <input type="text" id="search" placeholder="Type to Search">
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
                <tr class="clickable-row">
                    <td class="nrId">{{$teachers[$i]['id']}}</td>
                    <td class="nrName">{{$teachers[$i]['name']}}</td>
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
                    <input type="text" class="form-control" id="id" placeholder="ID" name="id" readonly>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" readonly>
                </div>
                <div class="form-group">
                    <label for="arrive">Arrival Time</label>
                    <input type="text" class="form-control" id="arrive" placeholder="Arrival Time" name="arrive">
                </div>
                <div class="form-group">
                    <label for="depart">Departure Time</label>
                    <input type="text" class="form-control" id="depart" placeholder="Arrival Time" name="depart">
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