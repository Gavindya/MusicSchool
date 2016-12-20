<div id="select-course" class="container">
    <form method="post">
        {{csrf_field()}}
        {{method_field('post')}}
        <div class="row">
            <div class="col-sm-4 form-group">
                <label for="class-id">Course</label>
                <select class="form-control" id="course-id" name="course-id">
                    <option selected disabled>Choose here</option>
                    @foreach($courses as $course)
                        <option value="{{$course['course_id']}}">{{$course['course_name']}}</option>
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