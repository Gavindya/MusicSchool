<div class="container">
    <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#div-course">Add new course
    </button>
    <span class="clearfix"><br></span>
    <div id="div-course" class="collapse">
        <form method="post">
            {{csrf_field()}}
            {{method_field('post')}}
            <div class="col-sm-4 form-group">
                <label for="course-name">Course</label>
                <input class="form-control" id="course-name" placeholder="Course Name" name="course_name">
            </div>
            <div class="col-sm-4 form-group">
                <label for="credits">Credits</label>
                <input type="number" min="0" max="10" class="form-control" id="credits" placeholder="Credits" name="credits">
            </div>
            <div class="col-sm-4 form-group">
                <label for="instrument-id">Instrument</label>
                <select class="form-control" id="instrument-id" name="instrument_id">
                    <option selected disabled>Choose here</option>
                    @foreach($instruments as $instrument)
                        <option value="{{$instrument['instrument_id']}}">{{$instrument['instrument_name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 form-group">
                <label for="weekday-input">Weekday</label>
                <select class="form-control" id="weekday-input" name="weekday">
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
                <label for="timeslot-id">Timeslot</label>
                <select class="form-control" id="timeslot-id" name="timeslot_id">
                    <option selected disabled>Choose here</option>
                    @foreach($timeslots as $timeslot)
                        <option value="{{$timeslot['timeslot_id']}}">{{$timeslot['start_time'].' - '.$timeslot['end_time']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 form-group">
                <label for="charges-amt">Charges</label>
                <input type="number" min="0" class="form-control" id="charges-amt" name="charges"
                       placeholder="Charges">
            </div>
            <div class="col-sm-4 form-group">
                <label for="teacher-id">Teacher</label>
                <select class="form-control" id="teacher-id" name="teacher_id">
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