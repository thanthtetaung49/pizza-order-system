<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderListController extends Controller
{
    // location to admin order list
    public function orderList(Request $request)
    {
        $adminOrders = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('orders.created_at', 'desc');

        if ($request->orderStatus != null) {
            $adminOrders = $adminOrders->where('orders.status', $request->orderStatus)->paginate(3);
        } else {
            $adminOrders = $adminOrders->paginate(3);
        }
        return view('admin.order.orderList', compact('adminOrders'));
    }

    // location to admin order list view
    public function orderListInfo($orderCode)
    {
        $totalPrice = Order::select('total_price')
            ->where('order_code', $orderCode)
            ->first();
        $orderInfos = OrderList::select('order_lists.*', 'users.name as user_name', 'products.name as product_name', 'products.image as product_image', 'products.view_count as product_view')
            ->leftJoin('users', 'users.id', 'order_lists.user_id')
            ->leftJoin('products', 'products.id', 'order_lists.product_id')
            ->where('order_lists.order_code', $orderCode)
            ->get();
        return view('admin.order.orderView', compact('totalPrice', 'orderInfos'));
    }
}
