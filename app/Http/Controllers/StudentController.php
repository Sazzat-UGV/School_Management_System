<?php

namespace App\Http\Controllers;

use App\Models\Schoolclass;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $students = User::with(['class:id,name'])->where('user_type', 'student');

        if ($request->name) {
            $students = $students->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->last_name) {
            $students = $students->where('last_name', 'LIKE', '%' . $request->last_name . '%');
        }
        if ($request->email) {
            $students = $students->where('email', 'LIKE', '%' . $request->email . '%');
        }
        if ($request->admission_number) {
            $students = $students->where('admission_number', 'LIKE', '%' . $request->admission_number . '%');
        }
        if ($request->roll_number) {
            $students = $students->where('roll_number', 'LIKE', '%' . $request->roll_number . '%');
        }
        if ($request->class) {
            $students = $students->where('class_id', 'LIKE', '%' . $request->class . '%');
        }
        if ($request->religion) {
            $students = $students->where('religion', 'LIKE', '%' . $request->religion . '%');
        }
        if ($request->phone) {
            $students = $students->where('phone', 'LIKE', '%' . $request->phone . '%');
        }
        if ($request->gender) {
            $students = $students->where('gender', $request->gender);
        }
        if ($request->blood_group) {
            $students = $students->where('blood_group', $request->blood_group);
        }
        if ($request->status) {
            $students = $students->where('status', $request->status);
        }

        if ($request->admission_date) {
            $students = $students->where('admission_date', $request->admission_date);
        }
        if ($request->dob) {
            $students = $students->where('dob', $request->dob);
        }
        $classes = Schoolclass::latest('id')->where('status', 1)->get();
        $students = $students->latest('id')->paginate(20);
        return view('admin.student.list', compact('students', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Schoolclass::latest('id')->where('status', 1)->get();
        return view('admin.student.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'admission_number' => 'nullable|string|max:255',
            'roll_number' => 'required|string|max:255',
            'class' => 'required|numeric',
            'gender' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'caste' => 'nullable|string|max:255',
            'religion' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:20',
            'admission_date' => 'required|date',
            'blood_group' => 'nullable|string|max:3',
            'height' => 'nullable|string|max:10',
            'weight' => 'nullable|string|max:10',
            'status' => 'required|numeric',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string',
            'photo' => 'nullable|mimes:png,jpg|max:10240',
        ]);
        $student = User::create([
            'name' => $request->first_name,
            'last_name' => $request->last_name,
            'admission_number' => $request->admission_number,
            'roll_number' => $request->roll_number,
            'class_id' => $request->class,
            'gender' => $request->gender,
            'dob' => $request->date_of_birth,
            'caste' => $request->caste,
            'religion' => $request->religion,
            'phone' => $request->mobile_number,
            'admission_date' => $request->admission_date,
            'blood_group' => $request->blood_group,
            'height' => $request->height,
            'weight' => $request->weight,
            'is_deletable' => '0',
            'user_type' => 'student',
            'status' => $request->status,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $this->image_upload($request, $student->id);
        Toastr::success('Student added successfully!', 'Success');
        return redirect()->route('student.index');
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
        $student = User::findOrFail($id);
        $classes = Schoolclass::latest('id')->where('status', 1)->get();
        return view('admin.student.edit', compact('student', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = User::findOrFail($id);
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'admission_number' => 'nullable|string|max:255',
            'roll_number' => 'required|string|max:255',
            'class' => 'required|numeric',
            'gender' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'caste' => 'nullable|string|max:255',
            'religion' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:20',
            'admission_date' => 'required|date',
            'blood_group' => 'nullable|string|max:3',
            'height' => 'nullable|string|max:10',
            'weight' => 'nullable|string|max:10',
            'status' => 'required|numeric',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $student->id,
            'password' => 'nullable|string',
            'photo' => 'nullable|mimes:png,jpg|max:10240',
        ]);
        $student->update([
            'name' => $request->first_name,
            'last_name' => $request->last_name,
            'admission_number' => $request->admission_number,
            'roll_number' => $request->roll_number,
            'class_id' => $request->class,
            'gender' => $request->gender,
            'dob' => $request->date_of_birth,
            'caste' => $request->caste,
            'religion' => $request->religion,
            'phone' => $request->mobile_number,
            'admission_date' => $request->admission_date,
            'blood_group' => $request->blood_group,
            'height' => $request->height,
            'weight' => $request->weight,
            'is_deletable' => '0',
            'user_type' => 'student',
            'status' => $request->status,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $this->image_upload($request, $student->id);
        Toastr::success('Student update successfully!', 'Success');
        return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = User::findorFail($id);
        if ($student->is_deletable == 1) {
            if ($student->photo != 'default_profile.png') {
                //delete old photo
                $photo_location = 'public/uploads/profile/';
                $old_photo_location = $photo_location . $student->photo;
                unlink(base_path($old_photo_location));
            }

            $student->delete();
            Toastr::success('Student delete successfully!', 'Success');
            return back();
        } else {
            Toastr::error("Can't delete the student", 'Error');
            return back();
        }

    }

    public function image_upload($request, $student_id)
    {
        $student = User::findorFail($student_id);

        if ($request->hasFile('photo')) {
            if ($student->photo != 'default_profile.png') {
                //delete old photo
                $photo_location = 'public/uploads/profile/';
                $old_photo_location = $photo_location . $student->photo;
                unlink(base_path($old_photo_location));
            }
            $photo_loation = 'public/uploads/profile/';
            $uploaded_photo = $request->file('photo');
            $new_photo_name = time() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_loation . $new_photo_name;
            Image::make($uploaded_photo)->resize(600, 600)->save(base_path($new_photo_location));
            $check = $student->update([
                'photo' => $new_photo_name,
            ]);
        }
    }
}
