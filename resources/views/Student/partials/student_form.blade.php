
<div class="form-group">
    <label for="student_firstname"><span class="req">* </span> First name: </label>
    <input class="form-control" placeholder="Enter Name" class="col-lg-2" type="text" name="student_firstname"
           value="{{old('student_firstname')}}" id="student_firstname" onkeyup="Validate(this)"
           required/>
    <div id="errFirst"></div>
</div>


<div class="form-group">
    <label for="student_lastname"><span class="req">* </span> Last name: </label>
    <input class="form-control" placeholder="Enter last name" type="text" name="student_lastname" id="student_lastname"
           onkeyup="Validate(this)"
           value="{{old('student_lastname')}}" required/>
    <div id="errLast"></div>
</div>


<div class="form-group">
    <label for="student_telephone"><span class="req">* </span> Phone Number: </label>
    <input required type="text" name="student_telephone" id="student_telephone" value="{{old('student_telephone')}}"
           class="form-control phone"
           onkeyup="validatephone(this);" placeholder=" Enter Phone Number"/>
</div>


<div class="form-group">
    <label for="student_address"><span class="req">* </span> Address: </label>
    <input class="form-control" value="{{old('student_address')}}" placeholder="Enter Address" required type="text"
           name="student_address" id="student_address"/>
    <div class="status" id="status"></div>
</div>

<div class="form-group">
    <label for="guardian_name"><span class="req">* </span>Guardian name: </label>
    <input class="form-control" placeholder="Enter Phone Number" value="{{old('guardian_name')}}" type="text"
           name="guardian_name" id="guardian_name" onkeyup="Validate(this)" required/>
    <div id="errFirst"></div>
</div>

<div class="form-group">
    <label for="guardian_telephone"><span class="req">* </span> Guardian Phone Number: </label>
    <input required type="text" value="{{old('guardian_telephone')}}" name="guardian_telephone" id="guardian_telephone"
           class="form-control phone" maxlength="28"
           onkeyup="validatephone(this);" placeholder="Enter PhonNumber"/>
</div>


<div class="form-group col-lg-offset-5">
    <input class="btn btn-success" class="pull-right" type="submit" name="submit_reg" value="Enroll">
</div>


</fieldset>
 

