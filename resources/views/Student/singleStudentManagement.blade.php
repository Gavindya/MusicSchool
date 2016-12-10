@extends('templates.newMaster')

@section('style')

    <title>Stylish Search Box - Bootsnipp.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/searchBar.css">
    <link rel="stylesheet" href="app/public/css/bootstrap.min.css">
@endsection


@section('script')
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

@endsection

@section('headline')
    Student Management
@endsection
@section('content')
    The student is {{$id}}

    <div class="dropdown ">
        <button class="btn btn-default dropdown-toggle col-lg-5" data-toggle="dropdown" aria-expanded="false"
                type="button" name="student-id">Select a student <span class="caret"></span></button>
        <ul class="dropdown-menu col-lg-5" role="menu" name="student">
            <li><a href="#">First Item</a></li>
            <li><a href="#">Second Item</a></li>
            <li><a href="#">Third Item</a></li>

        </ul>


        <div class="container-fluid ">
            <div class="table-responsive ">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Names</th>
                    </tr>
                    </thead>
                    <tbody>

                    @for($i =0; $i < sizeof($students); $i++)

                        <tr>
                            <div>
                                <td class=>{{$students[$i]['id']}}</td>
                                <td>{{$students[$i]['name']}}</td>
                            </div>

                        </tr>

                    @endfor
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div>
        <h1> Edit Student Information </h1>
        <form action="/student/{4}/update " method="POST">
            {{csrf_token()}}

            <div class="form-group">
                <label for="firstname"><span class="req">* </span> First name: </label>
                <input class="form-control" type="text" name="first_name" value="{{$students[$id-1]['name']}}" id="txt"
                       onkeyup="Validate(this)" required/>
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
                <input required type="text" name="student_phone_number" value="{{$students[$id-1]['telephone']}}"
                       id="phone" class="form-control phone" maxlength="28"
                       onkeyup="validatephone(this);" placeholder="Phone Number"/>
            </div>


            <div class="form-group">
                <label for="email"><span class="req">* </span> Address: </label>
                <input class="form-control" required type="text" value="{{$students[$id-1]['address']}}"
                       name="student_address" id="txt"/>
                <div class="status" id="status"></div>
            </div>

            <div class="form-group">
                <label for="firstname"><span class="req">* </span> Parent name: </label>
                <input class="form-control" type="text" name="guardian_name" id="phone" onkeyup="Validate(this)"
                       required/>
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

            {{csrf_field()}}
        </form>
    </div>







    @endsection