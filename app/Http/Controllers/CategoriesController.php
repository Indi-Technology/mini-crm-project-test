<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('admin');
        $category = Categories::all();

        return view('categories.categories', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('admin');
        return view('categories.form-category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('admin');

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = new Categories();

        $category->category_name = $request->name;
        $category->save();

        return Redirect::route('category.index')->with('status', 'add-category');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('admin');

        $category = Categories::find($id);

        return view('categories.form-category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('admin');

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Categories::find($id);

        $category->category_name = $request->name;
        $category->save();

        return Redirect::route('category.index')->with('status', 'edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('admin');

        $category = Categories::find($id);
        $category->delete();

        return Redirect::route('category.index')->with('status', 'delete-category');
    }
}
