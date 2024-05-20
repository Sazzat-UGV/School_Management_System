<?php

namespace App\Http\Controllers;

use App\Models\Schoolclass;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $classes = Schoolclass::with('user:id,name');

        if ($request->name) {
            $classes = $classes->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->date) {
            $classes = $classes->whereDate('created_at', $request->date);
        }

        $classes = $classes->latest('id')->paginate(20);

        return view('admin.class.list', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.class.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:schoolclasses,name',
            'status' => 'required|numeric',
        ]);

        $class = Schoolclass::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'status' => $request->status,
        ]);

        Toastr::success('Class added successfully!', 'Success');
        return redirect()->route('class.index');
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
        $class = Schoolclass::findOrFail($id);
        return view('admin.class.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $class = Schoolclass::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255|unique:schoolclasses,name,' . $class->id,
            'status' => 'required|numeric',
        ]);

        $class->update([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'status' => $request->status,
        ]);

        Toastr::success('Class updated successfully!', 'Success');
        return redirect()->route('class.index');
    }

/**
 * Remove the specified resource from storage.
 */
    public function destroy(string $id)
    {
        $class = Schoolclass::findOrFail($id);
        $class->delete();
        Toastr::success('Class deleted successfully!', 'Success');
        return back();
    }
}
