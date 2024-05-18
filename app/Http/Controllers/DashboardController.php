<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function dashboard(){
    if (Auth::user()->user_type == 'admin') {
        return view('admin.dashboard');
    } elseif (Auth::user()->user_type == 'teacher') {
        return view('teacher.dashboard');
    } elseif (Auth::user()->user_type == 'student') {
        return view('student.dashboard');
    } elseif (Auth::user()->user_type == 'parent') {
        return view('parent.dashboard');
    }
   }
}
