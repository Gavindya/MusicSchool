<?php

namespace App\Http\Controllers;

use App\DbConnection\DBConnection;
use App\DbModels\UsersTableConnector;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //


    public  function addUser(){
        return view('Users.add_user');
    }
    public function store(Request $request){
        $this->validate($request, [
            'first_name', 'last_name' => 'required|min:2|max:45',
            'type' => 'required',
            'email' =>'required|unique:users,email'
        ]);

        $conn = DBConnection::openConnection();

        $userConnector=new UsersTableConnector();

        $result2 = $userConnector->storeUser($conn, $request);

        session()->flash('msg', 'User Entry is successful.');
        return redirect()->back();

    }
}
