<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // location to user home page
    public function userHomePage()
    {
        $pizzas = Product::orderBy('created_at', 'desc')->paginate(6);
        $categories = Category::get();
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $orders = Order::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->paginate(5);

        return view('user.main.home', compact('pizzas', 'categories', 'carts', 'orders'));
    }

    // location to user/account/profile
    public function userProfile()
    {
        return view('user.account.details');
    }

    // location to user/account/editProfile
    public function editUserProfile()
    {
        return view('user.account.editProfile');
    }

    // edit userProfile
    public function edit(Request $request, $id)
    {
        $this->userValidationCheck($request);
        $userData = $this->userInsertData($request);

        if ($request->hasFile('image')) {
            if ($request->image != null) {
                $oldImageName = User::select('image')
                    ->where('id', $id)
                    ->first();
                $oldImageName = $oldImageName->image;

                Storage::delete('public/' . $oldImageName);
            }

            $imageName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $imageName);
            $userData['image'] = $imageName;
        }

        User::where('id', $id)->update($userData);

        return redirect()
            ->route('user#userProfile')
            ->with(['userUpdateSuccess' => 'User profile is updated.']);
    }

    // location to user/account/changePassword
    public function changePasswordPage()
    {
        return view('user.account.changeUserPassword');
    }

    // user change password
    public function changePassword(Request $request)
    {
        $this->userPasswordValidationCheck($request);
        $id = Auth::user()->id;
        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->oldPassword, $hashedPassword)) {
            User::where('id', $id)->update([
                'password' => Hash::make($request->newPassword),
            ]);

            return back()->with(['changed' => 'User password changed.']);
        } else {
            return back()->with(['failed' => "Password didn't match."]);
        }
    }

    // loaction to pizza/details
    public function detailPage($id)
    {
        $pizza = Product::where('id', $id)->first();
        $pizzaLists = Product::get();

        return view('user.main.details', compact('pizza', 'pizzaLists'));
    }

    // location to pizza/filter
    public function filter($categoryId)
    {
        $pizzas = Product::where('category_id', $categoryId)->paginate(6);
        $categories = Category::get();
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $orders = Order::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->paginate(5);

        return view('user.main.home', compact('pizzas', 'categories', 'carts', 'orders'));
    }

    // user password validation check
    private function userPasswordValidationCheck($request)
    {
        Validator::make(
            $request->all(),
            [
                'oldPassword' => 'required|min:6',
                'newPassword' => 'required|min:6',
                'confirmPassword' => 'required|min:6|same:newPassword',
            ],
            [
                'confirmPassword.same' => "New password and confirm password didn't match.",
            ],
        )->validate();
    }

    // user data
    private function userInsertData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
        ];
    }

    // check user validation
    private function userValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'image' => 'mimes:jpg,jpeg,png,webp',
        ])->validate();
    }
}
