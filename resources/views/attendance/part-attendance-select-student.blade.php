<div id="select-course" class="container">
    <form method="post">
        {{csrf_field()}}
        {{method_field('post')}}
        <div class="row">
            <div class="col-sm-4 form-group">
                <label for="student-id">Student ID</label>
                <select class="form-control" id="student-id" name="student-id">
                    <option selected disabled>Choose here</option>
                    @foreach($students as $student)
                        <option value="{{$student['student_id']}}">
                            {{$student['student_id']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="bottom">
            <div class="col-sm-4 form-group">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
</div>
</div>