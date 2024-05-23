<?php

namespace App\Http\Controllers;

use Image;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $parents = User::where('user_type', 'parent');

        if ($request->name) {
            $parents = $parents->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->last_name) {
            $parents = $parents->where('last_name', 'LIKE', '%' . $request->last_name . '%');
        }
        if ($request->email) {
            $parents = $parents->where('email', 'LIKE', '%' . $request->email . '%');
        }
        if ($request->gender) {
            $parents = $parents->where('gender',$request->gender);
        }
        if ($request->occupation) {
            $parents = $parents->where('occupation', 'LIKE', '%' . $request->occupation . '%');
        }
        if ($request->address) {
            $parents = $parents->where('address', 'LIKE', '%' . $request->address . '%');
        }
        if ($request->phone) {
            $parents = $parents->where('phone', 'LIKE', '%' . $request->phone . '%');
        }
        if ($request->status) {
            $parents = $parents->where('status',$request->status);
        }
        $parents = $parents->latest('id')->paginate(20);
        return view('admin.parent.list', compact('parents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.parent.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'gender' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:20',
            'status' => 'required|numeric',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string',
            'photo' => 'nullable|mimes:png,jpg|max:10240',
        ]);
        $parent = User::create([
            'name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'occupation' => $request->occupation,
            'phone' => $request->mobile_number,
            'is_deletable' => '1',
            'user_type' => 'parent',
            'status' => $request->status,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $this->image_upload($request, $parent->id);
        Toastr::success('Parent added successfully!', 'Success');
        return redirect()->route('parent.index');
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
        $parent = User::findOrFail($id);
        return view('admin.parent.edit', compact('parent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $parent = User::findOrFail($id);
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'occupation'=>'nullable|max:255',
            'gender' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:20',
            'status' => 'required|numeric',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $parent->id,
            'password' => 'nullable|string',
            'photo' => 'nullable|mimes:png,jpg|max:10240',
        ]);
        $parent->update([
            'name' => $request->first_name,
            'last_name' => $request->last_name,
            'occupation' => $request->occupation,
            'gender' => $request->gender,
            'phone' => $request->mobile_number,
            'is_deletable' => '0',
            'user_type' => 'parent',
            'status' => $request->status,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $this->image_upload($request, $parent->id);
        Toastr::success('Parent update successfully!', 'Success');
        return redirect()->route('parent.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $parent = User::findorFail($id);
        if ($parent->is_deletable == 1) {
            if ($parent->photo != 'default_profile.png') {
                //delete old photo
                $photo_location = 'public/uploads/profile/';
                $old_photo_location = $photo_location . $parent->photo;
                unlink(base_path($old_photo_location));
            }

            $parent->delete();
            Toastr::success('Parent delete successfully!', 'Success');
            return back();
        } else {
            Toastr::error("Can't delete the parent", 'Error');
            return back();
        }

    }

    public function image_upload($request, $parent_id)
    {
        $parent = User::findorFail($parent_id);

        if ($request->hasFile('photo')) {
            if ($parent->photo != 'default_profile.png') {
                //delete old photo
                $photo_location = 'public/uploads/profile/';
                $old_photo_location = $photo_location . $parent->photo;
                unlink(base_path($old_photo_location));
            }
            $photo_loation = 'public/uploads/profile/';
            $uploaded_photo = $request->file('photo');
            $new_photo_name = time() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_loation . $new_photo_name;
            Image::make($uploaded_photo)->resize(600, 600)->save(base_path($new_photo_location));
            $check = $parent->update([
                'photo' => $new_photo_name,
            ]);
        }
    }
}
