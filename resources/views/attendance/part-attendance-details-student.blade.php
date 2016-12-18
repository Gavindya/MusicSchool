<div class="container">

    @if(isset($attendances))
        <table class="table table-striped table-hover table-responsive">
            <thead>
            <tr>
                <th width="10%">Date</th>
                <th width="25%">Class</th>
                <th width="10%">Payment Status</th>
                <th width="15%">Present/Absent</th>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{$student['date']}}</td>
                    <td>{{$student['class']}}</td>
                    @if($student['status'] === 1)
                        <td class="text-success">Active</td>
                    @else
                        <td class="text-danger">Expired</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>