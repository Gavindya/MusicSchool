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
                <input type="number" min="0" max="10" class="form-control" id="credits" placeholder="Credits"
                       name="credits">
            </div>
            <div class="col-sm-4 form-group">
                <label for="instrument-id">Instrument</label>
                <select class="form-control" id="instrument-id" name="instrument_id"
                        onchange="refreshTeaches('instrument')">
                    <option selected disabled>Choose here</option>
                    @foreach($instruments as $instrument)
                        <option value="{{$instrument->instrument_id}}">{{$instrument->instrument_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 form-group">
                <label for="teacher-id">Teacher</label>
                <select class="form-control" id="teacher-id" name="teacher_id"
                        onchange="refreshTeaches('teacher')">
                    <option selected disabled>Choose here</option>
                    @foreach($teachers as $teacher)
                        <option value="{{$teacher->teacher_id}}">{{$teacher->teacher_name}}</option>
                    @endforeach
                </select>
            </div>

            {{--This script refreshes the instruments and teachers lists when either is changed--}}
            <script type="text/javascript">
                function refreshTeaches($param) {
                    var instrumentselect = $('#instrument-id');
                    var teacherselect = $('#teacher-id');
                    var id, elementToUpdate, elementSelectedId;

                    if ($param == 'teacher') {
                        id = teacherselect.find(":selected").val();
                        elementSelectedId = instrumentselect.find(":selected").val();
                        elementToUpdate = instrumentselect;
                    }
                    if ($param == 'instrument') {
                        id = instrumentselect.find(":selected").val();
                        elementSelectedId = teacherselect.find(":selected").val();
                        elementToUpdate = teacherselect;
                    }
                    $.ajax({
                        type: "GET",
                        contentType: "application/json; charset=utf-8",
                        url: "/teaches/" + $param + "/" + id,
                        success: function (Result) {
//                            Clear content of elementToUpdate initially
                            elementToUpdate.html($("<option selected disabled>Choose here</option>"));
                            $.each(Result, function (key, value) {
                                $selected = "";
                                if (value.id == elementSelectedId) $selected = "selected";
                                elementToUpdate.append($("<option " + $selected + "></option>").val(value.id).html(value.name));
                            });
                        }
                    });
                }
            </script>
            {{--End of Script--}}

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
                        <option value="{{$timeslot->timeslot_id}}">{{$timeslot->start_time.' - '.$timeslot->end_time}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 form-group">
                <label for="charges-amt">Charges</label>
                <input type="number" min="0" class="form-control" id="charges-amt" name="charges"
                       placeholder="Charges">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
            <button type="reset" class="btn btn-default" onclick="reloadTeachersInstruments()">Reset</button>
        </form>

        {{--This script reloads all instruments and teaches to dropdown boxes again--}}
        <script type="text/javascript">
            function reloadTeachersInstruments() {
                $.ajax({
                    type: "GET",
                    contentType: "application/json; charset=utf-8",
                    url: "/teachers/all",
                    success: function (Result) {
                        $('#teacher-id').html($("<option selected disabled>Choose here</option>"));
                        $.each(Result, function (key, value) {
                            $('#teacher-id').append($("<option></option>").val(value.teacher_id).html(value.teacher_name));
                        });
                    }
                });
                $.ajax({
                    type: "GET",
                    contentType: "application/json; charset=utf-8",
                    url: "/instruments/all",
                    success: function (Result) {
                        $('#instrument-id').html($("<option selected disabled>Choose here</option>"));
                        $.each(Result, function (key, value) {
                            $('#instrument-id').append($("<option></option>").val(value.instrument_id).html(value.instrument_name));
                        });
                    }
                });
            }
        </script>
        {{--End of script--}}
    </div>
</div>

