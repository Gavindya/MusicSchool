<?php

namespace App\Http\Controllers;

use App\DAO\CourseDAO;
use App\DAO\InstrumentDAO;
use App\DAO\TeacherDAO;
use App\Domain\Teacher;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Request;
//use Illuminate\Support\Facades\Session;
use Session;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getTeachersNames()
    {
        $dbCon = new TeacherDAO();
        $teachers =$dbCon->getNames();
        return $teachers;
    }
    public function getATeacher($id)
    {
        $dbCon = new TeacherDAO();
        $result = $dbCon->getATeacher($id);
        return $result;  //can be accessed as an array $result[0] = id etc
    }
    public function addTeacher(Request $request)
    {
        $dbTeacher = new TeacherDAO();
        $teacher = new Teacher();
        if (isset($request->name)) {
            $teacher->setTeacherName($request->name);
        }
        if (isset($request->telephone)) {
            $teacher->setTeacherTelephone($request->telephone);
        }
        if (isset($request->address)) {
            $teacher->setTeacherAddress($request->address);
        }
        $teacher->setTeacherJoindate(date("y-m-d"));
        $dbTeacher->addNewTeacher($teacher);
        return redirect()->route("TeacherManagement");

    }
    public function getTeachersWithoutPagination()
    {
        $dbCon = new TeacherDAO();
        $result = $dbCon->getAllTeachers();
        $teachers = json_decode(json_encode($result), TRUE);
        return $teachers;
    }

    public function getTeachersWithPagination()
    {
        $dbCon = new TeacherDAO();
        $teachers = $dbCon->getAllTeachers();

        $perPage = 4;
        $currentPage = Input::get('page') - 1;
        $pagedData = array_slice($teachers, $currentPage * $perPage, $perPage);
        $teachers = new LengthAwarePaginator($pagedData, count($teachers), $perPage);

        return $teachers;
    }

    public function getTeachersForManagement()
    {
        $teachers = $this->getTeachersWithPagination();
        $teachers->setPath('TeacherManagement');

        return view('TeacherManagement', ['teachers' => $teachers]);
    }
    public function getTeacherInformation($id)
    {
        $dbCon = new TeacherDAO();
        $teachers = $dbCon->getATeacher($id);

        $payments = new SalaryController();
        $paymentsHistory = $payments->getPaymentsOfTeacher($id);

        $instrumentsDAO = new InstrumentDAO();
        $instruments = $instrumentsDAO->getInstrumentsForTeacher($id);
        $allInstruments= $instrumentsDAO->getInstrumentsAll();

        $instrumentListOfTeacher = "";

        foreach($instruments as $ins){
            $instrumentListOfTeacher=$ins['instrument_name'].",".$instrumentListOfTeacher;
        }
//        echo var_dump($instrumentListOfTeacher);
        $clses = new CourseDAO();
        $clssAssigned = $clses->getCoursesOfTeacher($id);

        return view('TeacherInformation', ['teacher' => ($teachers),
            'payments' => ($paymentsHistory),
            'classes' => ($clssAssigned),
            'TeacherInstruments' => ($instrumentListOfTeacher),
            'allInstruments' => ($allInstruments)
        ]);
    }
    public function updateTeacher(Request $request)
    {
//        echo dd($request->all());
        $dbCon = new TeacherDAO();
        $telephone = $request->telephone;
        $address = $request->address;
        $id = $request->id;
        $newInstrument_id = $request->instrument_id;

        $msg=$dbCon->updateTeacher($telephone, $address, $id,$newInstrument_id);
        if($msg==="1"){
            Session::flash('updated', "Successfully updated the teacher");
            Session::flash('alertType', "alert-success");
        }else{
            Session::flash('updated', "Error Occurred");
            Session::flash('alertType', "alert-danger");
        }
        return redirect()->route('teacherInfo', ['id' => $id]);
    }

    public function updateTeacherHimself(Request $request){
        $dbCon = new TeacherDAO();
        $telephone = $request->telephone;
        $address = $request->address;
        $id = $request->id;
        $username = $request->username;
        $pw = $request->password;
        $re_pw = $request->re_password;
        $newInstrument_id = $request->instrument_id;

        $msg=$dbCon->updateTeacher($telephone, $address, $id,$newInstrument_id);
        $dbCon->updateUser($username,$pw);
        if($msg==="1"){
            Session::flash('updated', "Successfully updated the teacher");
            Session::flash('alertType', "alert-success");
        }else{
            Session::flash('updated', "Error Occurred");
            Session::flash('alertType', "alert-danger");
        }
        return redirect()->route('teacher', ['id' => $id]);
    }
    public function resignTeacher($id)
    {
        $tdao = new TeacherDAO();
        $msg = $tdao->setTeacherNotActive($id);
        Session::flash('msg', $msg);
        return redirect()->back();
    }

    public function getPersonalPage(){
//        USING ID OF Teacher!
        $id =1;
        
        $credentials = null;
        $dbCon = new TeacherDAO();
        $teachers = $dbCon->getATeacher($id);

        $payments = new SalaryController();
        $paymentsHistory = $payments->getPaymentsOfTeacher($id);

        $instrumentsDAO = new InstrumentDAO();
        $instruments = $instrumentsDAO->getInstrumentsForTeacher($id);
        $allInstruments= $instrumentsDAO->getInstrumentsAll();

        $instrumentList = "";

        foreach($instruments as $ins){
            $instrumentList=$ins['instrument_name'].",".$instrumentList;
        }
//        echo var_dump($instrumentList);
        $clses = new CourseDAO();
        $clssAssigned = $clses->getCoursesOfTeacher($id);

        return view('Teacher', ['teacher' => ($teachers),
            'payments' => ($paymentsHistory),
            'classes' => ($clssAssigned),
            'instrumentsOfTeacher' => ($instrumentList),
            'credentials'=>($credentials),
            'allInstruments' => ($allInstruments)
        ]);
    }
}
