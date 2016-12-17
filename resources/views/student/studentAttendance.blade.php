@extends('layouts.master')

@section('title', 'Student Attendance')

@section('sidebar')
    @parent
    <p>This is appended to the master sidebar.</p>
@stop

@section('content')
    <div class="container">

    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img class="center-block" src="{{URL::asset('/images/Schoolgirl.png')}}" alt="Student Photo" width=75%>
                <h3>Index Number</h3>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for index number...">
                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Search</button>
                    </span>
                </div>
            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-5">
                <h4>Class Active Status</h4>
                @if(isset($active))
                    @if($active)
                        <div class="well-sm alert-success">
                            <h4 class="text-center text-success">Active</h4>
                        </div>
                    @else
                        <div class="well-sm alert-danger">
                            <h4 class="text-center text-danger">Expired</h4>
                        </div>
                    @endif
                @else
                    <div class="well-sm alert-info">
                        <h4 class="text-center text-info">Pending</h4>
                    </div>
                @endif
                <div class="well-sm">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th width="50%">Date</th>
                                <th width="50%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($attendances as $attendance)
                            <tr>
                                <td>{{$attendance['date']}}</td>
                                <td>{{$attendance['state']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop