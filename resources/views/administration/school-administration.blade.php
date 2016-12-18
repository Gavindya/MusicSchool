@extends('layouts.app')

@section('title', 'School Administration')

@section('content')
    <div class="container"><h1>School Administration</h1></div>

    {{--Timeslots Section--}}
    <div class="container">
        <h2>Timeslots</h2>
        <div class="container col-sm-6">
            <h3>Add Timeslot</h3>
            {{--Form for adding timeslots--}}
            <form id="form-add-timeslot" method="post" action="{{url('/administration/timeslots/add')}}">
                {{csrf_field()}}
                {{method_field('post')}}
                <div class="col-sm-6 form-group">
                    <label for="start-time">Start Time</label>
                    <input type="time" class="form-control" id="start-time" placeholder="Start Time" name="start_time">
                </div>
                <div class="col-sm-6 form-group">
                    <label for="end-time">End Time</label>
                    <input type="time" class="form-control" id="end-time" placeholder="End Time" name="end_time">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                <button type="reset" class="btn btn-default">Reset</button>
            </form>
        </div>
        <div class="container col-sm-6">
            <h3>Edit Timeslots</h3>
            {{--Form for editing timeslots--}}
            <form id="form-edit-timeslot" method="post" action="{{url('/administration/timeslots/edit')}}">
                {{csrf_field()}}
                {{method_field('post')}}
                <div class="form-group">
                    <label for="timeslot-id">Timeslot</label>
                    <select class="form-control" id="timeslot-id" name="timeslot_id">
                        <option selected disabled>Choose here</option>
                        @foreach($timeslots as $timeslot)
                            <option value="{{$timeslot->timeslot_id}}">{{$timeslot->start_time.' - '.$timeslot->end_time}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="start-time">Start Time</label>
                    <input type="time" class="form-control" id="start-time" placeholder="Start Time" name="start_time">
                </div>
                <div class="col-sm-6 form-group">
                    <label for="end-time">End Time</label>
                    <input type="time" class="form-control" id="end-time" placeholder="End Time" name="end_time">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                <button type="reset" class="btn btn-default">Reset</button>
            </form>
        </div>
    </div>

    {{--Instruments Section--}}
    <div class="container">
        <h2>Instruments</h2>
        <div class="container col-sm-6">
            <h3>Add Instrument</h3>
            {{--Form for adding instruments--}}
            <form id="form-add-instrument" method="post" action="{{url('/administration/instruments/add')}}">
                {{csrf_field()}}
                {{method_field('post')}}
                <div class="form-group">
                    <label for="instrument-name">Instrument</label>
                    <input class="form-control" id="instrument-name" placeholder="Instrument" name="instrument_name">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                <button type="reset" class="btn btn-default">Reset</button>
            </form>
        </div>
        <div class="container col-sm-6">
            <h3>Edit Instruments</h3>
            {{--Form for editing instruments--}}
            <form id="form-edit-instrument" method="post" action="{{url('/administration/instruments/edit')}}">
                {{csrf_field()}}
                {{method_field('post')}}
                <div class="col-sm-6 form-group">
                    <label for="instrument-id">Instrument</label>
                    <select class="form-control" id="instrument-id" name="instrument_id">
                        <option selected disabled>Choose here</option>
                        @foreach($instruments as $instrument)
                            <option value="{{$instrument->instrument_id}}">{{$instrument->instrument_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="instrument-name">Instrument Name</label>
                    <input class="form-control" id="instrument-name" placeholder="Instrument" name="instrument_name">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                <button type="reset" class="btn btn-default">Reset</button>
            </form>
        </div>
    </div>
@stop