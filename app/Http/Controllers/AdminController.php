<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // location to admin/changePassword
    public function changePasswordPage()
    {
        return view('admin.account.changePassword');
    }

    // change password
    public function passwordChange(Request $request)
    {
        /*
        1. all field must be fill
        2. new password and old password must be greater than the length 6
        3. new password and confirm password must be same
        4. client old password must be same with db password
        5. password change
        */
        // $2y$10$MCbbbuhVDzsogXTqZmsJUOtwuVdsld5r5PTfIehiRDeD4eHaVCIqS

        $this->passwordChangeValidationCheck($request);

        $currentUserId = Auth::user()->id;
        $oldDatabasePassword = User::select('password')
            ->where('id', $currentUserId)
            ->first();
        $oldPassword = $request->oldPassword;
        // dd($oldDatabasePassword->toArray(), $oldPassword);

        if (Hash::check($oldPassword, $oldDatabasePassword->password)) {
            $hashedNewPassword = ['password' => Hash::make($request->newPassword)];

            User::where('id', $currentUserId)->update($hashedNewPassword);
            // Auth::logout();

            return back()->with(['changed' => 'Password changed.']);
        } else {
            return back()->with(['failed' => "Your old password didn't match. Please try again!"]);
        }
    }

    // location to admin/accountInfo
    public function info()
    {
        return view('admin.account.details');
    }

    // location to admin/edit
    public function adminEdit()
    {
        return view('admin.account.edit');
    }

    // admin update
    public function updateAccountInfo(Request $request, $id)
    {
        $this->adminAccountValidationCheck($request);
        $updateData = $this->adminAccountUpdateData($request);

        if ($request->hasFile('image')) {
            $oldPhoto = User::where('id', $id)->first();
            $oldPhotoName = $oldPhoto->image;

            if (Auth::user()->image != null) {
                Storage::delete('public/' . $oldPhotoName);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $updateData['image'] = $fileName;
        }

        User::where('id', $id)->update($updateData);

        return redirect()
            ->route('admin#info')
            ->with(['updateAccountInfo' => 'Account Updated.']);
    }

    // location to admin/adminsList
    public function adminList()
    {
        $admins = User::when(request('search'), function ($query) {
            $key = request('search');
            $query
                ->orWhere('name', 'like', '%' . $key . '%')
                ->orWhere('email', 'like', '%' . $key . '%')
                ->orWhere('phone', 'like', '%' . $key . '%')
                ->orWhere('gender', 'like', '%' . $key . '%')
                ->orWhere('address', 'like', '%' . $key . '%');
        })
            ->where('role', 'admin')
            ->paginate(3);

        return view('admin.account.adminsList', compact('admins'));
    }

    // admin delete
    public function adminsDelete($id)
    {
        User::where('id', $id)->delete();

        return redirect()
            ->route('admin#adminsList')
            ->with(['deleteSuccess' => 'One Admin deleted.']);
    }

    // location to admin/changeRole
    public function changeRole($id)
    {
        $account = User::where('id', $id)->first();
        // dd($account->toArray());

        return view('admin.account.roleChange', compact('account'));
    }

    // change role
    public function role(Request $request, $id)
    {
        $role = $this->roleChangeData($request);
        User::where('id', $id)->update($role);

        return redirect()->route('admin#adminsList');
    }

    // role change data
    private function roleChangeData($request)
    {
        return ['role' => $request->role];
    }

    // admin account validation check
    private function adminAccountValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'image' => 'mimes:jpg,png,jpeg,webp',
        ])->validate();
    }

    // admin account update data
    private function adminAccountUpdateData($request)
    {
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
        ];

        return $updateData;
    }

    // Account password change validation
    private function passwordChangeValidationCheck($request)
    {
        Validator::make(
            $request->all(),
            [
                'oldPassword' => 'required|',
                'newPassword' => 'required|min:6',
                'confirmPassword' => 'required|min:6|same:newPassword',
            ],
            [
                'confirmPassword.same' => "Password didn't match.",
            ],
        )->validate();
    }
}
