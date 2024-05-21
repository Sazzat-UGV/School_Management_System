<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\Schoolclass;
use App\Models\Subject;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $assigns = ClassSubject::with(['user:id,name', 'class:id,name', 'subject:id,name']);

        if ($request->class_name) {
            $assigns = $assigns->where('class_id', 'LIKE', '%' . $request->class_name . '%');
        }

        if ($request->subject_name) {
            $assigns = $assigns->where('subject_id', 'LIKE', '%' . $request->subject_name . '%');
        }

        if ($request->date) {
            $assigns = $assigns->where('created_at', 'LIKE', '%' . $request->date . '%');
        }

        $assigns = $assigns->latest('id')->paginate(20);
        $classes = Schoolclass::latest('id')->where('status', 1)->get();
        $subjects = Subject::latest('id')->where('status', 1)->get();
        return view('admin.assign_subject.list', compact('assigns', 'classes', 'subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Schoolclass::latest('id')->where('status', 1)->get();
        $subjects = Subject::latest('id')->where('status', 1)->get();
        return view('admin.assign_subject.create', compact('classes', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|numeric',
            'subject_name.*' => 'required|numeric',
            'status' => 'required|numeric',
        ]);
        foreach ($request->subject_name as $subject_id) {
            ClassSubject::create([
                'user_id' => Auth::user()->id,
                'class_id' => $request->class_name,
                'subject_id' => $subject_id,
                'status' => $request->status,
            ]);

        }
        Toastr::success('Subject successfully assign to class', 'Success');
        return redirect()->route('assign.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $assign = ClassSubject::findOrFail($id);
        $classes = Schoolclass::latest('id')->where('status', 1)->get();
        $subjects = Subject::latest('id')->where('status', 1)->get();
        return view('admin.assign_subject.edit', compact('assign', 'classes', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'class_name' => 'required|numeric',
            'subject_name' => 'required|numeric',
            'status' => 'required|numeric',
        ]);
        $assign = ClassSubject::findOrFail($id);
        $assign->update([
            'user_id' => Auth::user()->id,
            'class_id' => $request->class_name,
            'subject_id' => $request->subject_name,
            'status' => $request->status,
        ]);

        Toastr::success('Subject successfully assign to class', 'Success');
        return redirect()->route('assign.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $assign = ClassSubject::findOrFail($id);
        if ($assign->is_deletable == 1) {
            $assign->delete();
            Toastr::success('Assign data deleted successfully!', 'Success');
            return back();
        } else {
            Toastr::error("Can't delete the assign data", 'Error');
            return back();
        }
    }
}
