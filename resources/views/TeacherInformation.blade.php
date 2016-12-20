@extends('templates.newMaster')
@section('script')
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
            document.getElementById("telephone").removeAttribute('readonly');
            document.getElementById("address").removeAttribute('readonly');
            document.getElementById("update").removeAttribute('disabled');
        }
    </script>

@endsection
@section('headline')
    Teacher Information
@endsection

@section('content')

    <h2>Personal Details</h2>
    <div>
        <div id="msgArea">
            @if(Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}
                    <button id="m" class="glyphicon glyphicon-remove pull-right"></button></p>
            @endif
            @if(Session::has('updated'))
                <p class="alert {{ Session::get('alertType') }}">{{ Session::get('updated') }}
                    <button id="m" class="glyphicon glyphicon-remove pull-right"></button></p>
            @endif
        </div>
    </div>
    <div id="form" class="row">
        <form method="post" action="/updateTeacher">
            {{method_field('PATCH')}}
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" id="id" placeholder="ID" readonly name="id" value={{$teacher['teacher_id']}}>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" readonly
                           value={{$teacher['teacher_name']}}>
                </div>
                <div class="form-group">
                    <label for="instruments">Instruments</label>
                    <input type="text" class="form-control" id="instruments" readonly name="instruments" value={{$TeacherInstruments}}>
                </div>

                <label for="instrument-id">Add Instrument</label>
                <select class="form-control" id="instrument-id" name="instrument_id">
                    <option selected disabled>Choose here</option>
                    @foreach($allInstruments as $instrument)
                        <option value="{{$instrument['instrument_id']}}">{{$instrument['instrument_name']}}</option>
                    @endforeach
                </select>

            </div>
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="telephone">Telephone Number</label>
                    <input type="text" class="form-control" id="telephone" placeholder="Telephone Number"
                           name="telephone" pattern="^\d{10}$" readonly value={{$teacher['teacher_telephone']}}>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" pattern=".{3,}"
                           readonly value={{$teacher['teacher_address']}}>
                </div>
            </div>
            <div class="form-group container-fluid pull-left">
                <button id="update" disabled type="submit" class="btn btn-primary">Update teacher</button>
            </div>
            <div class="form-group">
                <button class="btn-primary btn" type="reset">Cancel</button>
            </div>
            {{csrf_field()}}
        </form>

        <div class="pull-right container-fluid">
            <input type="button" id="edit" onclick="edit()" value="Edit" class="btn-primary btn"/>

            <a href="{{ route('resign',['id' => $teacher['teacher_id']])}}"
               onclick="return confirm('Are you sure you want to resign {{$teacher['teacher_name']}}?')"
               class="btn-primary btn">Resign</a>
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
                <th width="30%">Course</th>
                <th width="15%">Instrument</th>
                <th width="15%">Date</th>
                <th width="15%">Start Time</th>
                <th width="15%">End Time</th>
                <th width="5%">Charges</th>
                <th width="5%">Status</th>
            </tr>
            </thead>
            <tbody>
            @for($i =0; $i < sizeof($classes) ; $i++)
                <tr class="clickable-row">
                    <td>{{$classes[$i]['course_id']}}&nbsp;{{$classes[$i]['course_name']}}</td>
                    <td>{{$classes[$i]['instrument_name']}}</td>
                    <td>{{$classes[$i]['weekday']}}</td>
                    <td>{{$classes[$i]['start_time']}}</td>
                    <td>{{$classes[$i]['end_time']}}</td>
                    <td>{{$classes[$i]['charges']}}</td>
                    <td>status</td>
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
                <th width="10%">Payment ID</th>
                <th width="30%">Amount</th>
                <th width="30%">Payment Date</th>
            </tr>
            </thead>
            <tbody>
            @for($j =0; $j < sizeof($payments) ; $j++)
                <tr class="clickable-row">
                    <td>{{$payments[$j]['payment_id']}}</td>
                    <td>{{$payments[$j]['amount']}}</td>
                    <td>{{$payments[$j]['paid_date']}}</td>

                </tr>
            @endfor
            {{--{{$teachers->links()}}--}}
            </tbody>
        </table>
    </div>
@endsection
