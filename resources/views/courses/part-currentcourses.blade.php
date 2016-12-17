<div class="container">
    <h2>Current Courses</h2>
    <table class="table table-hover table-responsive">
        <thead>
        <tr>
            <th width="25%">Name</th>
            <th width="20%">Instrument</th>
            <th width="10%">Weekday</th>
            <th width="20%">Timeslot</th>
            <th width="25%">Teacher</th>
        </tr>
        </thead>
        <tbody>
        @foreach($courses as $course)
            <tr onclick="window.location='/courses/{{$course['course_id']}}';">
                <td>{{$course['course_name']}}</td>
                <td>{{$course['instrument_name']}}</td>
                <td>{{$course['weekday']}}</td>
                <td>{{$course['start_time'].' - '.$course['end_time']}}</td>
                <td>{{$course['teacher_name']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>