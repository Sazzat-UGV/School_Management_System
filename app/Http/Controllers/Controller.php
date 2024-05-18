<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function admin_dashboard()
    {
        return view('admin.dashboard');
    }
    public function teacher_dashboard()
    {
        return view('teacher.dashboard');
    }
    public function student_dashboard()
    {
        return view('student.dashboard');
    }
    public function parent_dashboard()
    {
        return view('parent.dashboard');
    }

    public function admin_list()
    {
        return view('admin.admin.list');
    }
}
