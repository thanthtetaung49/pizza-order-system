<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // location to user order history
    public function orderHistory()
    {
        $orders = Order::orderBy('created_at', 'desc')
            ->where('user_id', Auth::user()->id)
            ->paginate(5);
        return view('user.main.history', compact('orders'));
    }
}
