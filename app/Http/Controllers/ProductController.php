<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // location to menu/list
    public function menuList()
    {
        $menus = Product::select('products.*', 'products.name as product_name', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->when(request('search'), function ($query) {
                $key = request('search');
                $query->orWhere('products.name', 'like', '%' . $key . '%')->orWhere('products.description', 'like', '%' . $key . '%');
            })
            ->orderBy('products.created_at', 'desc')
            ->paginate(3);

        return view('admin.menu.menuList', compact('menus'));
    }

    // location to menu/createPage
    public function createPage()
    {
        $categories = Category::select('id', 'name')->get();

        return view('admin.menu.create', compact('categories'));
    }

    // menu create
    public function create(Request $request)
    {
        $this->menuValidationCheck($request);
        $data = $this->menuInsertData($request);

        if ($request->hasFile('image')) {
            $imageName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $imageName);
            $data['image'] = $imageName;
        }

        Product::create($data);

        return redirect()->route('menu#list');
    }

    // menu delete
    public function delete($id)
    {
        Product::where('id', $id)->delete();

        return redirect()
            ->route('menu#list')
            ->with(['deleteSuccess' => 'Menu deleted.']);
    }

    // location to menu/details
    public function details($id)
    {
        $menu = Product::select('products.*', 'products.name as product_name', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.id', $id)
            ->first();

        return view('admin.menu.details', compact('menu'));
    }

    // location to menu/editPage
    public function editPage($id)
    {
        $menu = Product::where('id', $id)->first();
        $categories = Category::get();

        return view('admin.menu.edit', compact('categories', 'menu'));
    }

    // menu update
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|unique:products,name,' . $request->id,
            'description' => 'required',
            'category' => 'required',
            'image' => 'mimes:jpg,jpeg,png,webp',
            'price' => 'required',
            'time' => 'required',
        ])->validate();

        $data = $this->menuInsertData($request);
        $id = $request->id;

        if ($request->hasFile('image')) {
            $oldPhotoName = Product::select('image')
                ->where('id', $id)
                ->first();
            $oldPhotoName = $oldPhotoName->image;

            if ($oldPhotoName != null) {
                Storage::delete('public/' . $oldPhotoName);
            }

            $photoName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $photoName);
            $data['image'] = $photoName;
        }

        Product::where('id', $id)->update($data);

        return redirect()->route('menu#list');
    }

    // menu data insert
    private function menuInsertData($request)
    {
        $data = [
            'category_id' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'waiting_time' => $request->time,
        ];

        return $data;
    }

    // menu validation check
    private function menuValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required|unique:products,name',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,webp',
            'price' => 'required',
            'time' => 'required',
        ])->validate();
    }
}
