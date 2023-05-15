<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    // location to ajax/getData
    public function getData(Request $request)
    {
        if ($request->status == 'asc') {
            $data = Product::orderBy('created_at', 'asc')->get();
        } else {
            $data = Product::orderBy('created_at', 'desc')->get();
        }

        return $data;
    }

    // location to ajax/cartData
    public function cartData(Request $request)
    {
        $cartData = $this->insertCartData($request);
        Cart::create($cartData);

        $response = ['condition' => 'success'];

        return response()->json($response, 200);
    }

    // location to ajax/orderList
    public function orderList(Request $request)
    {
        $orderList = $this->insertOrderList($request);

        Cart::where('user_id', Auth::user()->id)->delete();
        OrderList::create($orderList);
        return response()->json(
            [
                'status' => 'true',
            ],
            200,
        );
    }

    // location to ajax/order
    public function order(Request $request)
    {
        $orderData = $this->insertOrderData($request);
        Order::create($orderData);
        return response()->json(
            [
                'status' => 'true',
            ],
            200,
        );
    }

    // order list clear
    public function orderClear(Request $request)
    {
        Cart::where('id', $request->orderId)
            ->where('user_id', Auth::user()->id)
            ->delete();
    }

    // order list all clear
    public function allClear()
    {
        Cart::select('*')->delete();
    }

    // location to admin order change status 
    public function adminOrderChangeStatus(Request $request){
        Order::where('id', $request->id)->update([
            "status" => $request->status
        ]);
        return response([
            "status" => "success"
        ], 200);
    }

    // location to adminPanel user List
    public function adminPanelUserList(Request $request){
        User::where('id', $request->userId)->update([
            "role" => $request->userRole
        ]);
    }

    // location to pizza view
    public function pizzaView(Request $request) {
        Product::where("id", $request->productId)->update([
            "view_count" => $request->viewCount + 1
        ]);

        return response([
            "status" => "success"
        ], 200);
    }

    // insert order data
    private function insertOrderData($request)
    {
        return [
            'user_id' => Auth::user()->id,
            'order_code' => $request->code,
            'total_price' => $request->subTotal + 3000,
        ];
    }

    // insert orderlist data
    private function insertOrderList($request)
    {
        return [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'quantity' => $request->quantity,
            'total' => $request->total,
            'order_code' => $request->orderCode,
        ];
    }

    // insert cart data
    private function insertCartData($request)
    {
        return [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'quantity' => $request->cartValue,
        ];
    }
}
