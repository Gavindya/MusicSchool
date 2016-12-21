<?php

namespace App\Http\Controllers;

use Auth;

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

        if(Auth::check()) {
            $user = Auth::user();
            if ($user->role == 'teacher') {
                return view('userLanding');
            } elseif ($user->role == 'staff') {
                return redirect()->route('TeacherAttendence');
            } elseif ($user->role == 'admin') {
                return view('LandingPages.Admin.admin');
            }
        } else{
            return view('login');
        }
    }
}
