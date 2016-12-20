<div class="container">

    @if(isset($students))
        <form method="post" action="/Attendance/Mark/MarkAttendance">
            {{csrf_field()}}
            {{method_field('post')}}

            <div>
                <table class="table table-striped table-hover table-responsive">
                    <thead>
                    <tr>
                        <th width="20%">Student Id</th>
                        <th width="20%">First Name</th>
                        <th width="30%">Last Name</th>
                        <th width="15%">Payment Status</th>
                        <th width="15%">Present/Absent</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{$student['student_id']}}</td>
                            <td>{{$student['student_firstname']}}</td>
                            <td>{{$student['student_lastname']}}</td>
                            @if($student['status'] === 1)
                                <td class="text-success">Active</td>
                            @else
                                <td class="text-danger">Expired</td>
                            @endif
                            <td><input type="checkbox" name="present[]" value="{{$student['enrolment_id']}}"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="bottom">
                <div class="col-sm-4 form-group">
                    <button type="submit" class="btn btn-default">Mark</button>
                </div>
            </div>
        </form>
    @endif
</div>