<?php

namespace App\Http\Controllers;

use App\DAO\ConnectionManager;
use App\UserDAO;
use Illuminate\Http\Request;

class LogInController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function login()
    {
        return view('LogIn.login');
    }

    public function loginUser(Request $request)
    {

        $conn = ConnectionManager::getConnection();
        // return $request->password;
        $userConnector = new UserDAO();
        list($conn, $result) = $userConnector->checkUser($conn, $request);

        if ($request->password == $result[0]["password"]) {
            session()->flash('msg', 'Log In is successful.');
            return view('Student.new_student');
        } else {
            session()->flash('msg', 'Index or password is incorrect');
            return redirect()->back();
        }

        // return  $result;


    }
}
