<?php

namespace App\Http\Controllers;

use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class ProfileController extends Controller
{
    public function change_password_page()
    {
        return view('profile.change_password');
    }
    public function change_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6|same:retype_password',
        ]);
        $currentPassword = Hash::check($request->old_password, Auth::user()->password);

        if ($currentPassword) {
            $user = User::findorFail(Auth::user()->id);
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
            Toastr::success('Password has been changed successfully!', 'Success');
            return back();
        } else {
            Toastr::error('Invalid password!', 'Error');
            return back();
        }

    }

    public function teacher_profile_page()
    {
        return view('teacher.profile');
    }

    public function teacher_profile_update(Request $request ,$id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'mobile_number' => 'required|string|max:20',
            'marital_status' => 'required|string|max:100',
            'current_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'work_experience' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'photo' => 'required|mimes:png,jpg|max:10240',
        ]);
        $user->update([
            'name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'dob' => $request->date_of_birth,
            'phone' => $request->mobile_number,
            'marital_status' => $request->marital_status,
            'address' => $request->current_address,
            'permanent_address' => $request->permanent_address,
            'qualification' => $request->qualification,
            'work_experience' => $request->work_experience,
            'email' => $request->email,
        ]);
        $this->image_upload($request, $user->id);
        Toastr::success('Profile update successfully!', 'Success');
        return redirect()->back();
    }

    public function image_upload($request, $user_id)
    {
        $user = User::findorFail($user_id);

        if ($request->hasFile('photo')) {
            if ($user->photo != 'default_profile.png') {
                //delete old photo
                $photo_location = 'public/uploads/profile/';
                $old_photo_location = $photo_location . $user->photo;
                unlink(base_path($old_photo_location));
            }
            $photo_loation = 'public/uploads/profile/';
            $uploaded_photo = $request->file('photo');
            $new_photo_name = time() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_loation . $new_photo_name;
            Image::make($uploaded_photo)->resize(600, 600)->save(base_path($new_photo_location));
            $check = $user->update([
                'photo' => $new_photo_name,
            ]);
        }
    }
}
