<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // get categories
    public function categories()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();

        return response()->json($categories, 200);
    }

    // get contacts
    public function contacts()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();

        return response()->json($contacts, 200);
    }

    // get orders
    public function orders()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();

        return response()->json($orders, 200);
    }

    // get order list
    public function orderLists()
    {
        $orderLists = OrderList::orderBy('created_at', 'desc')->get();

        return response()->json($orderLists, 200);
    }

    // get products
    public function products()
    {
        $products = Product::orderBy('created_at', 'desc')->get();

        return response()->json($products, 200);
    }

    // get users
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return response()->json($users, 200);
    }

    // create categories
    public function createCategories(Request $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ])->get();

        return response()->json($category, 200);
    }

    // delete categories POST
    public function deleteCategories(Request $request)
    {
        $data = Category::where('id', $request->id)->first();

        if (isset($data)) {
            $data = Category::where('id', $request->id)->delete();

            return response()->json(
                [
                    'status' => 'true',
                    'message' => 'delete success',
                ],
                200,
            );
        }
        return response()->json(
            [
                'status' => 'false',
                'message' => 'delete unsuccess.',
            ],
            200,
        );
    }

    // delete categories GET
    public function delete($id)
    {
        $data = Category::where('id', $id)->first();

        if (isset($data)) {
            $data = Category::where('id', $id)->delete();
            return response()->json(
                [
                    'status' => 'true',
                    'message' => 'delete success',
                ],
                200,
            );
        }
        return response()->json(
            [
                'status' => 'false',
                'message' => 'delete unsuccess',
            ],
            200,
        );
    }

    // detail category GET
    public function category($id)
    {
        $category = Category::where('id', $id)->first();

        if (isset($category)) {
            return response()->json($category, 200);
        }
        return response()->json(
            [
                'status' => 'false',
                'message' => 'error',
            ],
            500,
        );
    }

    // detail category POST
    public function categoryPost(Request $request)
    {
        $category = Category::where('id', $request->category_id)->first();

        if (isset($category)) {
            return response()->json(['status' => true, 'category' => $category], 200);
        }
        return response()->json(['status' => false, 'message' => 'error'], 500);
    }

    // update category GET
    public function updateCategory(Request $request)
    {
        $category = Category::where('id', $request->category_id)->first();

        if (isset($category)) {
            Category::where('id', $request->category_id)->update([
                'name' => $request->category_name,
            ]);
            return response()->json(
                [
                    'status' => true,
                    'category' => Category::get(),
                ],
                200,
            );
        }
        return response()->json(
            [
                'status' => false,
                'message' => 'error',
            ],
            200,
        );
    }
}
