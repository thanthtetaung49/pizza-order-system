<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserListController extends Controller
{
    // location admin user list
    public function userList(Request $request)
    {
        $users = User::when(request('search'), function ($query) {
            $key = request('search');
            $query->orWhere('name', 'like', '%' . $key . '%')->orWhere('phone', 'like', '%' . $key . '%');
        })
            ->where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(3);
        return view('admin.user.userList', compact('users'));
    }

    // user list delete
    public function userlistDelete($id)
    {
        User::where('id', $id)->delete();

        return redirect()->route('admin#userList');
    }

    // location to user list update
    public function userListEdit($id)
    {
        $user = User::where('id', $id)->first();

        return view('admin.user.userListEdit', compact('user'));
    }

    // update user list
    public function userListUpdate(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'image' => 'mimes:jpg,png,jpeg,webp',
        ])->validate();

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
        ];

        if ($request->file('image')) {
            if ($request->file('image') != null) {
                $oldName = User::select('image')
                    ->where('id', $id)
                    ->first();

                Storage::delete('public/' . $oldName->image);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $updateData['image'] = $fileName;
        }

        User::where('id', $id)->update($updateData);

        return back();
    }
}
