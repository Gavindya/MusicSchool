
<div class="form-group">
    <label for="firstname"><span class="req">* </span> First name: </label>
    <input class="form-control" class="col-lg-2" type="text" name="first_name" id="txt" onkeyup="Validate(this)"
           required/>
    <div id="errFirst"></div>
</div>


<div class="form-group">
    <label for="lastname"><span class="req">* </span> Last name: </label>
    <input class="form-control" type="text" name="last_name" id="txt" onkeyup="Validate(this)"
           placeholder="{{old('first_name')}}" required/>
    <div id="errLast"></div>
</div>


<div class="form-group">
    <label for="phonenumber"><span class="req">* </span> Phone Number: </label>
    <input required type="text" name="student_phone_number" id="phone" class="form-control phone" maxlength="28"
           onkeyup="validatephone(this);" placeholder="Phone Number"/>
</div>


<div class="form-group">
    <label for="email"><span class="req">* </span> Address: </label>
    <input class="form-control" required type="text" name="student_address" id="txt"/>
    <div class="status" id="status"></div>
</div>

<div class="form-group">
    <label for="firstname"><span class="req">* </span> Parent name: </label>
    <input class="form-control" type="text" name="guardian_name" id="phone" onkeyup="Validate(this)" required/>
    <div id="errFirst"></div>
</div>

<div class="form-group">
    <label for="phonenumber"><span class="req">* </span> Phone Number: </label>
    <input required type="text" name="guardian_phone" id="phone" class="form-control phone" maxlength="28"
           onkeyup="validatephone(this);" placeholder="not used for marketing"/>
</div>

<div class="form-group">
    <label for="class"><span class="req">*</span> Class:</label>

    <select class="form-control" name="class">
        <option value="">-- Select a class --</option>
        <option value="c1">Class1</option>
        <option value="c2">Class2</option>
        <option value="c3">Class3</option>
        <option value="c4">Class4</option>
        <option value="c5">Class5</option>
        <option value="c6">Class6</option>
        <option value="c7">Class7</option>
    </select>

</div>


<div class="form-group">

    <?php //$date_entered = date('m/d/Y H:i:s'); ?>
    <input type="hidden" value="<?php //echo $date_entered; ?>" name="dateregistered">
    <input type="hidden" value="0" name="activate"/>
    <hr>


</div>

<div class="form-group">
    <input class="btn btn-success" type="submit" name="submit_reg" value="Enroll">
</div>


</fieldset>
 

