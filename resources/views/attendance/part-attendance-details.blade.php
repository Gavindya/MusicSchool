<div class="container">

    @if(isset($attendances))
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
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{$attendance['student_id']}}</td>
                    <td>{{$attendance['student_firstname']}}</td>
                    <td>{{$attendance['student_lastname']}}</td>
                    @if($attendance['status'] === 1)
                        <td class="text-success">Active</td>
                    @else
                        <td class="text-danger">Expired</td>
                    @endif
                    @if($attendance['date'] === null)
                        <td class="text-danger">Absent</td>
                    @else
                        <td class="text-success">Present</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>