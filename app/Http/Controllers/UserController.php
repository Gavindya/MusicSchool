<?php

namespace App\Http\Controllers;

use App\DAO\ConnectionManager;
use App\DbConnection\DBConnection;
use App\DbModels\UsersTableConnector;
use App\UserDAO;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name', 'last_name' => 'required|min:2|max:45',
            'type' => 'required',
            'email' => 'required|unique:users,email'
        ]);

        $conn = ConnectionManager::getConnection();

        $userConnector = new UserDAO();

        $result2 = $userConnector->addUser($conn, $request);

        session()->flash('msg', 'User Entry is successful.');
        return redirect()->back();

    }
}
