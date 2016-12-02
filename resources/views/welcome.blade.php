<!DOCTYPE html>
<html lang="en">
<?php echo var_dump($students); ?>
@foreach($students as $student)
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Name" value="{{ $student->name }}">
        </div>

    </form>
@endforeach
</html>