<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        switch(Auth::user()->role){
            case 'admin'||'superadmin':{
                return view('admin/home');
                break;
            }
            case 'operator':{
                return view('operator/home');
                break;
            }
            case 'teacher':{
                return view('teacher/home');
                break;
            }
            case 'examiner':{
                return view('examiner/home');
                break;
            }
            case 'student':{
                return view('student/home');
                break;
            }
        }
        return view('home');
    }
}
