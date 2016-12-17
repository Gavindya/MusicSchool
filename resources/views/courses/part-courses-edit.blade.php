<div class="container">
    <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#div-course">Edit course
    </button>
    <span class="clearfix"><br></span>
    <div id="div-course" class="collapse">
        <form method="post">
            {{csrf_field()}}
            {{method_field('post')}}
            <div class="col-sm-4 form-group hidden">
                <label for="course-id">Course</label>
                <input class="form-control" id="course-id" placeholder="Course Id" name="course_id"
                       value="{{$course['course_id']}}">
            </div>
            <div class="col-sm-4 form-group">
                <label for="course-name">Course</label>
                <input class="form-control" id="course-name" placeholder="Course Name" name="course_name"
                       value="{{$course['course_name']}}">
            </div>

            <div class="col-sm-4 form-group">
                <label for="credits">Course</label>
                <input type="number" min="0" max="10" class="form-control" id="credits" placeholder="Credits"
                       name="credits" value="{{$course['credits']}}">
            </div>
            <div class="col-sm-4 form-group">
                <label for="instrument-id">Instrument</label>
                <select class="form-control" id="instrument-id" name="instrument_id">
                    @foreach($instruments as $instrument)
                        <option value="{{$instrument['instrument_id']}}"
                                @if($instrument['instrument_id'] == $course['instrument_id']) selected @endif>{{$instrument['instrument_name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 form-group">
                <label for="weekday-input">Weekday</label>
                <select class="form-control" id="weekday-input" name="weekday">
                    <option value="MON" @if($course['weekday'] == 'MON') selected @endif>Monday</option>
                    <option value="TUE" @if($course['weekday'] == 'TUE') selected @endif>Tuesday</option>
                    <option value="WED" @if($course['weekday'] == 'WED') selected @endif>Wednesday</option>
                    <option value="THU" @if($course['weekday'] == 'THU') selected @endif>Thursday</option>
                    <option value="FRI" @if($course['weekday'] == 'FRI') selected @endif>Friday</option>
                    <option value="SAT" @if($course['weekday'] == 'SAT') selected @endif>Saturday</option>
                    <option value="SUN" @if($course['weekday'] == 'SUN') selected @endif>Sunday</option>
                </select>
            </div>
            <div class="col-sm-4 form-group">
                <label for="timeslot-id">Timeslot</label>
                <select class="form-control" id="timeslot-id" name="timeslot_id">
                    @foreach($timeslots as $timeslot)
                        <option value="{{$timeslot['timeslot_id']}}"
                                @if($timeslot['timeslot_id'] == $course['timeslot_id']) selected @endif>{{$timeslot['start_time'].' - '.$timeslot['end_time']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 form-group">
                <label for="charges-amt">Charges</label>
                <input type="number" min="0" class="form-control" id="charges-amt" name="charges"
                       placeholder="Charges" value="{{$course['charges']}}">
            </div>
            <div class="col-sm-4 form-group">
                <label for="teacher-id">Teacher</label>
                <select class="form-control" id="teacher-id" name="teacher_id">
                    @foreach($teachers as $teacher)
                        <option value="{{$teacher['teacher_id']}}"
                                @if($teacher['teacher_id'] == $course['teacher_id']) selected @endif>{{$teacher['teacher_name']}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </form>
    </div>
</div>