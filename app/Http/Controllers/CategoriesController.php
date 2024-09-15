<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::oldest()->get();

        return view(
            'admin.categories.index',
            [
                'data' => $categories,
            ]
        );
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'categories_name' => 'required'
        ]);

        $input = $request->all();

        Categories::create($input);

        return redirect('/admin/categories');
    }

    public function show(Categories $categories)
    {
        //
    }

    public function edit(Categories $category)
    {
        return view('admin.categories.edit', [
            'categories' => $category
        ]);
    }


    public function update(Request $request, Categories $category)
    {
        $validatedData = $request->validate([
            'categories_name' => 'required'
        ]);

        $category->update($validatedData);

        return redirect('/admin/categories');
    }

    public function destroy(Categories $category)
    {
        $category->delete();

        return redirect('/admin/categories');
    }
}
