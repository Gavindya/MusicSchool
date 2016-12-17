
<div class="form-group">
    <label for="firstname"><span class="req">* </span> First name: </label>
    <input class="form-control" placeholder="Enter Name" class="col-lg-2" type="text" name="first_name"
           value="{{old('first_name')}}" id="txt" onkeyup="Validate(this)"
           required/>
    <div id="errFirst"></div>
</div>


<div class="form-group">
    <label for="lastname"><span class="req">* </span> Last name: </label>
    <input class="form-control" placeholder="Enter last name" type="text" name="last_name" id="txt"
           onkeyup="Validate(this)"
           value="{{old('last_name')}}" required/>
    <div id="errLast"></div>
</div>


<div class="form-group">
    <label for="phonenumber"><span class="req">* </span> Phone Number: </label>
    <input required type="text" name="student_phone_number" id="phone" value="{{old('student_phone_number')}}"
           class="form-control phone"
           onkeyup="validatephone(this);" placeholder=" Enter Phone Number"/>
</div>


<div class="form-group">
    <label for="email"><span class="req">* </span> Address: </label>
    <input class="form-control" value="{{old('student_address')}}" placeholder="Enter Address" required type="text"
           name="student_address" id="txt"/>
    <div class="status" id="status"></div>
</div>

<div class="form-group">
    <label for="firstname"><span class="req">* </span>Guardian name: </label>
    <input class="form-control" placeholder="Enter Phone Number" value="{{old('guardian_name')}}" type="text"
           name="guardian_name" id="phone" onkeyup="Validate(this)" required/>
    <div id="errFirst"></div>
</div>

<div class="form-group">
    <label for="phonenumber"><span class="req">* </span> Guardian Phone Number: </label>
    <input required type="text" value="{{old('guardian_phone')}}" name="guardian_phone" id="phone"
           class="form-control phone" maxlength="28"
           onkeyup="validatephone(this);" placeholder="Enter PhonNumber"/>
</div>


<div class="form-group col-lg-offset-5">
    <input class="btn btn-success" class="pull-right" type="submit" name="submit_reg" value="Enroll">
</div>


</fieldset>
 

