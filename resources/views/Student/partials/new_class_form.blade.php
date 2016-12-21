<div class="form-group">
    <label for="firstclass"><span class="req">* </span> Class: </label>
    <select class="form-control" name="course_id">
        <option selected value="">-- Select a class --</option>
        @foreach($courses as $course)
            <option value="{{$course->course_id}}">{{$course->course_name}}</option>
        @endforeach
    </select>
</div>


<div class="form-group">
    <input class="btn btn-success" type="submit" name="submit_reg" value="Enroll">
</div>


</fieldset>
