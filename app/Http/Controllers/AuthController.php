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
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // location to dashboard
    public function dashboard()
    {
        if (Auth::user()->role == 'admin') {
            $categories = Category::when(request('search'), function ($query) {
                $key = request('search');
                $query->orWhere('name', 'like', '%' . $key . '%');
            })
                ->orderBy('id', 'desc')
                ->paginate(4);

            return view('admin.category.list', compact('categories'));
        }
        
        if (Auth::user()->role == 'user') {
            $pizzas = Product::orderBy('created_at', 'desc')->paginate(6);
            $categories = Category::get();
            $carts = Cart::where('user_id', Auth::user()->id)->get();
            $orders = Order::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->paginate(5);

            return view('user.main.home', compact('categories', 'pizzas', 'carts', 'orders'));
        }
    }

    // location to login page
    public function loginPage()
    {
        return view('login');
    }

    // location to register page
    public function registerPage()
    {
        return view('register');
    }
}
