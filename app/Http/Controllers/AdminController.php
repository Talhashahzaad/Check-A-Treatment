<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    //

    public function AdminDashboard()
    {
        return view('admin.index');
    } //end method AdminDashboard

    public function AdminLogin()
    {
        return view('admin.admin_login');
    } //end method AdminLogin


    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Admin Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/admin/login')->with($notification);
    } //end method AdminLogout

    public function AdminProfile()
    {
        $id = Auth::user()->id;

        $profileData = User::find($id);
        return view('admin.admin_profile_view', compact('profileData'));
    } //end method AdminProfile

    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        if ($request->file('photo')) {
            $file =  $request->file('photo');
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('/upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    } //end method AdminProfileStore

    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password', compact('profileData'));
    } //end method AdminChangePassword

    public function AdminUpdatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        //Matches the old password

        if (!Hash::check($request->old_password, Auth::user()->password)) {

            $notification = array(
                'message' => 'Old Password Does not match',
                'alert-type' => 'error',
            );

            return back()->with($notification);
        }

        //Change the password

        User::whereId(auth()->user()->id)->update([

            'password' => Hash::make($request->new_password)

        ]);

        $notification = array(
            'message' => 'Password changed successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    } //end method AdminUpdatePassword
}
