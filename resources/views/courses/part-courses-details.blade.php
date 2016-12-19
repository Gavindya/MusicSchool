<div class="container">

    <table class="table table-striped table-hover table-responsive">
        <thead>
        <tr>
            <th width="25%">Course Name</th>
            <th width="10%">Credits</th>
            <th width="15%">Instrument</th>
            <th width="10%">Weekday</th>
            <th width="15%">Timeslot</th>
            <th width="15%">Teacher</th>
            <th width="10%">Charges</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$course->course_name}}</td>
                <td>{{$course->credits}}</td>
                <td>{{$course->instrument_name}}</td>
                <td>{{$course->weekday}}</td>
                <td>{{$course->start_time.' - '.$course->end_time}}</td>
                <td>{{$course->teacher_name}}</td>
                <td>{{$course->charges}}</td>
            </tr>
        </tbody>
    </table>

</div>