<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

 
    public function index(){

        $user=Auth::user();
        if ($user->role=='teacher'){
//            return view('LandingPages.Teacher.teacher');
            return view('userLanding');
        }
        elseif ($user->role=='staff'){
            return redirect()->route('TeacherAttendence');
        }
        elseif ($user->role=='admin'){
            return view('LandingPages.Admin.admin');
        }
    }
}
