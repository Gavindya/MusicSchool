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
    Add Fees
@endsection
@section('content')
    The student is {{$id}}
    <div class="container-fluid ">

        <div class="table-responsive ">
            <table class="table">
                <thead>
                <tr>
                    <th>Student Id</th>
                    <th>Enroll Id</th>
                    <th>Class_id</th>
                    <th>Active</th>
                    <th>Date</th>

                </tr>
                </thead>
                <tbody>
                @for($i =0; $i < sizeof($enrolments); $i++)

                    <tr>
                        <div>
                            <td class=>{{$enrolments[$i]['student_id']}}</td>
                            <td>{{$enrolments[$i]['id']}}</td>
                            <td>{{$enrolments[$i]['class_id']}}</td>
                            <td>{{$enrolments[$i]['active']}}</td>
                            <td>{{$enrolments[$i]['created_at']}}</td>

                        </div>
                    </tr>
                @endfor

                </tbody>
            </table>
        </div>
    </div>




    <div class="container">
        <div class="col-lg-6">
            <h1> Enter Fee</h1>
            <form action=/student/addfee/{{$id}} method="POST">

                {{method_field('PATCH')}}
                <div class="form-group">
                    <label for="name"><span class="req">* </span> {{$students[$id-1]['name']}}: </label>

                </div>
                <div class="form-group">
                    <label for="class"><span class="req">*</span> Class:</label>

                    <select class="form-control" name="class_id">
                        <option value="">-- Select a class --</option>
                        <option value=1>Class1</option>
                        <option value=2>Class2</option>
                        <option value="3">Class3</option>
                        <option value="4">Class4</option>
                        <option value="5">Class5</option>
                        <option value="6">Class6</option>
                        <option value="7">Class7</option>
                        @for($i =0; $i < sizeof($enrolments); $i++)
                            <option value='{{$enrolments[$i]['class_id']}}'>{{$enrolments[$i]['class_id']}}</option>
                        @endfor
                    </select>

                </div>
                <label for="class"><span class="req">*</span> fee:</label>

                <select class="form-control" name="fee">
                    <option value="">-- Select Fee --</option>
                    @for($i =0; $i < sizeof($classDetails); $i++)

                        <option value="{{$classDetails[$i]['charges']}}">{{$classDetails[$i]['charges']}}</option>
                    @endfor
                </select>

                <div class="form-group">
                    <input class="btn btn-success" type="submit" name="submit_reg" value="Pay"/>
                </div>


                </fieldset>

                {{csrf_field()}}
            </form>
        </div>
    </div>








@endsection