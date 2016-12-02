<!DOCTYPE html>
<html lang="en">
<?php
echo var_dump($students); ?>
@for($i =0; $i < sizeof($students); $i++)
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name"
                   value="{{$students[$i]}}">
        </div>

    </form>
@endfor
</html>