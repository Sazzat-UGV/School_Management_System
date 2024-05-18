<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

    public function forget_password_page()
    {
        return view('auth.forget');
    }

    public function forget_password(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->remember_token = Str::random(30);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return back()->with('success', 'A reset link sent to your email address.');
        } else {
            return back()->with('error', 'Email not found in the system.');
        }
    }

    public function reset_password_page($remember_token)
    {
        $user = User::where('remember_token', $remember_token)->first();
        if ($user) {
            return view('auth.reset', compact('user'));
        } else {
            abort(404);
        }
    }

    public function reset_password(Request $request, $remember_token)
    {
        if ($request->password == $request->confirm_password) {
            $user = User::where('remember_token', $remember_token)->first();
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();
            return redirect()->route('loginPage')->with('success', 'Password reset successfully.');
        } else {
            return back()->with('error', 'Password and confirm password does not match');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginPage');
    }
}
