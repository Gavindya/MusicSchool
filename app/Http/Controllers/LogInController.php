<?php

namespace App\Http\Controllers;

use App\UserDAO;
use Illuminate\Http\Request;
use Session;

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

    public function showLoginView()
    {
        return view('LogIn.login');
    }

    public function loginUser(Request $request)
    {
        $userDAO = new UserDAO();
        $object = $request->all();
        $result = $userDAO->checkUser($object['email'], $object['password']);

        if ($request->password == $result[0]["password"]) {
            Session::flash('msg', 'Log In is successful.');
            return view('Student.new_student');
        } else {
            Session::flash('msg', 'Index or password is incorrect');
            return redirect()->back();
        }
    }
}
