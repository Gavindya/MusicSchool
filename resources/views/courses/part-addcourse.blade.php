<div class="container">
    <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#addCourse">Add new course
    </button>
    <span class="clearfix"><br></span>
    <div id="addCourse" class="collapse">
        <form method="post" action="{{route('addCourse')}}">
            {{csrf_field()}}
            {{method_field('patch')}}
            <div class="col-sm-4 form-group">
                <label for="courseNameInput">Course</label>
                <input class="form-control" id="courseNameInput" placeholder="Course Name" name="course_name">
            </div>
            <div class="col-sm-4 form-group">
                <label for="instrumentIdInput">Instrument</label>
                <select class="form-control" id="instrumentIdInput" name="instrument_id">
                    <option selected disabled>Choose here</option>
                    @foreach($instruments as $instrument)
                        <option value="{{$instrument['instrument_id']}}">{{$instrument['instrument_name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 form-group">
                <label for="weekdayInput">Weekday</label>
                <select class="form-control" id="weekdayInput" name="weekday">
                    <option selected disabled>Choose here</option>
                    <option value="MON">Monday</option>
                    <option value="TUE">Tuesday</option>
                    <option value="WED">Wednesday</option>
                    <option value="THU">Thursday</option>
                    <option value="FRI">Friday</option>
                    <option value="SAT">Saturday</option>
                    <option value="SUN">Sunday</option>
                </select>
            </div>
            <div class="col-sm-4 form-group">
                <label for="timeslotInput">Timeslot</label>
                <select class="form-control" id="timeslotInput" name="timeslot_id">
                    <option selected disabled>Choose here</option>
                    @foreach($timeslots as $timeslot)
                        <option value="{{$timeslot['timeslot_id']}}">{{$timeslot['start_time'].' - '.$timeslot['end_time']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 form-group">
                <label for="chargesInput">Charges</label>
                <input type="number" min="0" class="form-control" id="chargesInput" name="charges"
                       placeholder="Charges">
            </div>
            <div class="col-sm-4 form-group">
                <label for="teacherIdInput">Teacher</label>
                <select class="form-control" id="teacherIdInput" name="teacher_id">
                    <option selected disabled>Choose here</option>
                    @foreach($teachers as $teacher)
                        <option value="{{$teacher['teacher_id']}}">{{$teacher['teacher_name']}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </form>
    </div>
</div>