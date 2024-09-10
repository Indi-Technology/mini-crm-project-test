<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list()
    {
        $data = [
            'title' => 'List Categories',
            'categories' => Category::orderBy("created_at", "desc")->paginate(10)
        ];

        return view('admin.categories.list', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Create Category',
        ];

        return view('admin.categories.create', $data);
    }
    public function save(Request $request)
    {
        $validate = $request->validate([
            'category_name' => 'required|min:3'
        ]);

        Category::create($validate);

        return redirect('/admin/categories')->with('success', 'Category Sucessfully Saved');
    }
    public function delete(Request $request)
    {
        $id = $request->id;

        Category::where('id', $id)->delete();

        return redirect("/admin/categories")->with('success', "Category Successfully Deleted");
    }
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Category',
            'category' => Category::find($id)
        ];

        return view('admin.categories.edit', $data);
    }
    public function update(Request $request)
    {
        $validate = $request->validate([
            'category_name' => 'required|min:3'
        ]);

        $categories = Category::find($request->id);

        $categories->update([
            'category_name' => $validate['category_name']
        ]);

        return redirect('/admin/categories')->with('success', 'Category Successfully Updated');
    }
}
