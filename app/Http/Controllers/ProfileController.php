<?php

namespace App\Http\Controllers;

use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
}
