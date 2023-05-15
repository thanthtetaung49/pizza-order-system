<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // location to category/list
    public function listPage()
    {
        $categories = Category::when(request('search'), function ($query) {
            $key = request('search');
            $query->orWhere('name', 'like', '%' . $key . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(4);

        return view('admin.category.list', compact('categories'));
    }

    // location to category/createPage
    public function createPage()
    {
        return view('admin.category.create');
    }

    // category create
    public function create(Request $request)
    {
        $this->categoryValidationCheck($request);
        $data = $this->categoryInsertData($request);

        Category::create($data);

        return redirect()->route('category#listPage');
    }

    // category delete
    public function delete($id)
    {
        Category::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Category deleted.']);
    }

    // location category/editPage
    public function editPage($id)
    {
        $data = Category::where('id', $id)->first();

        return view('admin.category.edit', compact('data'));
    }

    // category edit
    public function edit(Request $request, $id)
    {
        $validationRulue = [
            'categoryName' => 'required|unique:categories,name,' . $id,
        ];
        Validator::make($request->all(), $validationRulue)->validate();

        $data = $this->categoryInsertData($request);
        Category::where('id', $id)->update($data);

        return redirect()->route('category#listPage');
    }

    // category insert data
    private function categoryInsertData($request)
    {
        $data = ['name' => $request->categoryName];
        return $data;
    }

    // category validation check
    private function categoryValidationCheck($request)
    {
        Validator::make($request->all(), [
            'categoryName' => 'required|unique:categories,name',
        ])->validate();
    }
}
