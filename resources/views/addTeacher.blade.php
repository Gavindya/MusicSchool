<!DOCTYPE html>
<html lang="en">
<?php
echo var_dump($teachers); ?>
@for($i =0; $i < sizeof($teachers); $i++)
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name"
                   value="{{$teachers[$i]}}">
        </div>

    </form>
@endfor

<hr>
<form method="post" action="/addTeacher">
    {{method_field('PATCH')}}
    <div class="form-group">
        <label for="name">NAME</label>
        <textarea name="name" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <button type="submit">Add teacher</button>
    </div>
    {{csrf_field()}}
</form>

</html>