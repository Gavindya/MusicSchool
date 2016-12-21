<div class="container">

    <h2>Assignment Details</h2>
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
                    <td class="assignment_id">{{$assignment->assignment_id}}</td>
                    <td class="assignment_title">{{$assignment->assignment_title}}</td>
                    <td class="marks">{{$assignment->marks}}</td>
                </tr>
            @endforeach

            </tbody>

        </table>
        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#div-assignments">Add
            Assignment
        </button>
        <span class="clearfix"><br></span>
        <div id="div-assignments" class="collapse">
            <form method="post" action="{{url('/assignments/add')}}">
                {{csrf_field()}}
                {{method_field('post')}}
                <div class="col-sm-4 form-group hidden">
                    <label for="course-id">Assignment Name</label>
                    <input class="form-control" id="course-id" placeholder="Course Id" value="{{$course->course_id}}"
                           name="course_id">
                </div>
                <div class="col-sm-4 form-group">
                    <label for="assignment-name">Assignment Name</label>
                    <input class="form-control" id="assignment-name" placeholder="Assignment Name"
                           name="title">
                </div>
                <div class="col-sm-4 form-group">
                    <label for="marks">Total Marks</label>
                    <input type="number" min="0" max="10" class="form-control" id="marks" placeholder="Marks"
                           name="marks">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                <button type="reset" class="btn btn-default">Reset</button>
            </form>
        </div>
    </div>
</div>