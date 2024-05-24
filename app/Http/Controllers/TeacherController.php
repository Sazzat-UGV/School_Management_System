<?php

namespace App\Http\Controllers;

use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $teachers = User::where('user_type', 'teacher');

        if ($request->name) {
            $teachers = $teachers->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->last_name) {
            $teachers = $teachers->where('last_name', 'LIKE', '%' . $request->last_name . '%');
        }
        if ($request->email) {
            $teachers = $teachers->where('email', 'LIKE', '%' . $request->email . '%');
        }
        if ($request->gender) {
            $teachers = $teachers->where('gender', $request->gender);
        }
        if ($request->marital_status) {
            $teachers = $teachers->where('marital_status', 'LIKE', '%' . $request->marital_status . '%');
        }
        if ($request->address) {
            $teachers = $teachers->where('address', 'LIKE', '%' . $request->address . '%');
        }
        if ($request->phone) {
            $teachers = $teachers->where('phone', 'LIKE', '%' . $request->phone . '%');
        }
        if ($request->date_of_joining) {
            $teachers = $teachers->where('date_of_joining', 'LIKE', '%' . $request->date_of_joining . '%');
        }
        if ($request->status) {
            $teachers = $teachers->where('status', $request->status);
        }
        $teachers = $teachers->latest('id')->paginate(20);
        return view('admin.teacher.list', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'gender' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'date_of_joining' => 'required|date',
            'mobile_number' => 'required|string|max:20',
            'marital_status' => 'required|string|max:100',
            'status' => 'required|numeric',
            'current_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'work_experience' => 'required|string|max:255',
            'note' => 'nullable|string|max:2000',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string',
            'photo' => 'nullable|mimes:png,jpg|max:10240',
        ]);
        $teacher = User::create([
            'name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'dob' => $request->date_of_birth,
            'date_of_joining' => $request->date_of_joining,
            'phone' => $request->mobile_number,
            'marital_status' => $request->marital_status,
            'is_deletable' => '0',
            'user_type' => 'teacher',
            'status' => $request->status,
            'address' => $request->current_address,
            'permanent_address' => $request->permanent_address,
            'qualification' => $request->qualification,
            'work_experience' => $request->work_experience,
            'note' => $request->note,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $this->image_upload($request, $teacher->id);
        Toastr::success('Teacher added successfully!', 'Success');
        return redirect()->route('teacher.index');
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
        $teacher = User::findOrFail($id);
        return view('admin.teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teacher = User::findOrFail($id);
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'gender' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'date_of_joining' => 'required|date',
            'mobile_number' => 'required|string|max:20',
            'marital_status' => 'required|string|max:100',
            'status' => 'required|numeric',
            'current_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'work_experience' => 'required|string|max:255',
            'note' => 'nullable|string|max:2000',
            'email' => 'required|email|max:255|unique:users,email,' . $teacher->id,
            'password' => 'nullable|string',
            'photo' => 'nullable|mimes:png,jpg|max:10240',
        ]);
        $teacher->update([
            'name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'dob' => $request->date_of_birth,
            'date_of_joining' => $request->date_of_joining,
            'phone' => $request->mobile_number,
            'marital_status' => $request->marital_status,
            'is_deletable' => '0',
            'user_type' => 'teacher',
            'status' => $request->status,
            'address' => $request->current_address,
            'permanent_address' => $request->permanent_address,
            'qualification' => $request->qualification,
            'work_experience' => $request->work_experience,
            'note' => $request->note,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $this->image_upload($request, $teacher->id);
        Toastr::success('Teacher update successfully!', 'Success');
        return redirect()->route('teacher.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = User::findorFail($id);
        if ($teacher->is_deletable == 1) {
            if ($teacher->photo != 'default_profile.png') {
                //delete old photo
                $photo_location = 'public/uploads/profile/';
                $old_photo_location = $photo_location . $teacher->photo;
                unlink(base_path($old_photo_location));
            }

            $teacher->delete();
            Toastr::success('Teacher delete successfully!', 'Success');
            return back();
        } else {
            Toastr::error("Can't delete the teacher", 'Error');
            return back();
        }

    }

    public function image_upload($request, $teacher_id)
    {
        $teacher = User::findorFail($teacher_id);

        if ($request->hasFile('photo')) {
            if ($teacher->photo != 'default_profile.png') {
                //delete old photo
                $photo_location = 'public/uploads/profile/';
                $old_photo_location = $photo_location . $teacher->photo;
                unlink(base_path($old_photo_location));
            }
            $photo_loation = 'public/uploads/profile/';
            $uploaded_photo = $request->file('photo');
            $new_photo_name = time() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_loation . $new_photo_name;
            Image::make($uploaded_photo)->resize(600, 600)->save(base_path($new_photo_location));
            $check = $teacher->update([
                'photo' => $new_photo_name,
            ]);
        }
    }
}
