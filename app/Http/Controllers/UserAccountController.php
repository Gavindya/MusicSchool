<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    public function userLogout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
