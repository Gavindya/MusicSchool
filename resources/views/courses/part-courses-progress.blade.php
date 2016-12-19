<div class="container">

    <h2>Course Progress</h2>
    <div class="container">
        <table id="course_progress" class="table table-bordered table-hover table-responsive">
            <thead>
            <tr>
                <th>Id</th>
                <th>Assignment Name</th>
                <th>Total Marks</th>
            </tr>
            </thead>
            <tbody>

            @foreach($assignments as $assignment)
                <tr class="clickable-row">
                    <td class="assignment_id">{{$assignment['assignment_id']}}</td>
                    <td class="assignment_title">{{$assignment['assignment_title']}}</td>
                    <td class="marks">{{$assignment['marks']}}</td>
                </tr>
            @endforeach

            </tbody>

        </table>
    </div>
</div>