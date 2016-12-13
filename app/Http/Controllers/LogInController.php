<?php

namespace App\Http\Controllers;

use App\DbConnection\DBConnection;
use App\DbModels\UsersTableConnector;
use Illuminate\Http\Request;

class LogInController extends Controller
{
    //

    public function login(){
        return view('LogIn.login');
    }
    public function loginUser(Request $request){

        $conn = DBConnection::openConnection();
       // return $request->password;
        $userConnector=new UsersTableConnector();
        list($conn,$result)=$userConnector->checkUser($conn, $request);

        if ($request->password==$result[0]["password"]){
            session()->flash('msg', 'Log In is successful.');
            return view('Student.new_student');
        }
        else
        {
            session()->flash('msg', 'Index or password is incorrect');
            return redirect()->back();
        }

       // return  $result;
        
        
    }
}
