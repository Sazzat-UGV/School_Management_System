<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_page()
    {
        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->user_type == 'teacher') {
                return redirect()->route('teacher.dashboard');
            } elseif (Auth::user()->user_type == 'student') {
                return redirect()->route('student.dashboard');
            } elseif (Auth::user()->user_type == 'parent') {
                return redirect()->route('parent.dashboard');
            }
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, filled($request->remember))) {
            $request->session()->regenerate();
            if (Auth::user()->user_type == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->user_type == 'teacher') {
                return redirect()->route('teacher.dashboard');
            } elseif (Auth::user()->user_type == 'student') {
                return redirect()->route('student.dashboard');
            } elseif (Auth::user()->user_type == 'parent') {
                return redirect()->route('parent.dashboard');
            }
        }
        return redirect()->route('loginPage')->with('error', 'Invalid email or password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginPage');
    }
}
