<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $admins = User::where('user_type', 'admin');

        if ($request->name) {
            $admins = $admins->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->email) {
            $admins = $admins->where('email', 'LIKE', '%' . $request->email . '%');
        }

        if ($request->date) {
            $admins = $admins->whereDate('created_at', $request->date);
        }

        $admins = $admins->latest('id')->paginate(20);

        return view('admin.admin.list', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'password' => 'required|string',
            'photo' => 'nullable|mimes:png,jpg|max:10240',
        ]);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'dob' => $request->dob,
            'password' => Hash::make($request->password),
            'user_type' => 'admin',
        ]);

        $this->image_upload($request, $admin->id);
        Toastr::success('Admin added successfully!', 'Success');
        return redirect()->route('admin.index');
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
        $admin = User::findOrFail($id);
        return view('admin.admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $admin->id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'password' => 'nullable|string',
            'photo' => 'nullable|mimes:png,jpg|max:10240',
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'dob' => $request->dob,
            'password' => Hash::make($request->password),
            'user_type' => 'admin',
        ]);
        $this->image_upload($request, $admin->id);
        Toastr::success('Admin update successfully!', 'Success');
        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::findOrFail($id);
        if ($admin->is_deletable == 1) {
            if ($admin->photo != 'default_profile.png') {
                //delete old photo
                $photo_location = 'public/uploads/profile/';
                $old_photo_location = $photo_location . $admin->photo;
                unlink(base_path($old_photo_location));
            }

            $admin->delete();
            Toastr::success('Admin delete successfully!', 'Success');
            return back();
        } else {
            Toastr::error("Can't delete the admin", 'Error');
            return back();
        }
    }

    public function image_upload($request, $admin_id)
    {
        $admin = User::findorFail($admin_id);

        if ($request->hasFile('photo')) {
            if ($admin->photo != 'default_profile.png') {
                //delete old photo
                $photo_location = 'public/uploads/profile/';
                $old_photo_location = $photo_location . $admin->photo;
                unlink(base_path($old_photo_location));
            }
            $photo_loation = 'public/uploads/profile/';
            $uploaded_photo = $request->file('photo');
            $new_photo_name = time() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_loation . $new_photo_name;
            Image::make($uploaded_photo)->resize(600, 600)->save(base_path($new_photo_location));
            $check = $admin->update([
                'photo' => $new_photo_name,
            ]);
        }
    }
}
