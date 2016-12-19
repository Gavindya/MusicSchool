<div class="form-group">

    <label for="user type"><span class="req">* </span> User Type: </label>
    <select class="form-control" name="role">

        <option value="">-- Select User Role --</option>
        <option value="1">Administrator</option>
        <option value="2">Teacher</option>
        <option value="3">Third Party personnel</option>


    </select>


</div>


<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <input type="text" name="name" id="first_name" class="form-control input-sm" placeholder="First Name">
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name">
        </div>
    </div>
</div>

<div class="form-group">
    <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email">
</div>


<input type="submit" value="Add User" class="btn btn-info btn-block">

</form>
