<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subjects = Subject::with('user:id,name');

        if ($request->name) {
            $subjects = $subjects->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if (!empty($request->type)) {
            $subjects = $subjects->where('type', 'LIKE', '%' . $request->type . '%');
        }

        if ($request->date) {
            $subjects = $subjects->whereDate('created_at', $request->date);
        }

        $subjects = $subjects->latest('id')->paginate(20);

        return view('admin.subject.list', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|numeric',
            'type' => 'required|string|max:50',
        ]);

        $subject = Subject::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'status' => $request->status,
            'type' => $request->type,
        ]);

        Toastr::success('Subject added successfully!', 'Success');
        return redirect()->route('subject.index');
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
        $subject = Subject::findOrFail($id);
        return view('admin.subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|numeric',
            'type' => 'required|string|max:50',
        ]);
        $subject = Subject::findOrFail($id);

        $subject->update([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'status' => $request->status,
            'type' => $request->type,
        ]);

        Toastr::success('Subject updated successfully!', 'Success');
        return redirect()->route('subject.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::findOrFail($id);
        if ($subject->is_deletable == 1) {
            $subject->delete();
            Toastr::success('Subject deleted successfully!', 'Success');
            return back();
        } else {
            Toastr::error("Can't delete the subject", 'Error');
            return back();
        }
    }
}
