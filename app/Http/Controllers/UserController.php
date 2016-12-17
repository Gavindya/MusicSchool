<?php

namespace App\Http\Controllers;

use App\User;
use App\UserDAO;
use Illuminate\Http\Request;
use Session;

class UserController extends Controller
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


    public function addUser()
    {
        return view('Users.add_user');
    }

    public function insertUser(Request $request)
    {
        $this->validate($request, [
            'first_name', 'last_name' => 'required|min:2|max:45',
            'type' => 'required',
            'email' => 'required|unique:users,email'
        ]);

        $userDAO = new UserDAO();
        $object = $request->all();
        $user = new User($object);
        $userDAO->addUser($user);

        Session::flash('msg', 'User Entry is successful.');
        return redirect()->back();
    }
}
