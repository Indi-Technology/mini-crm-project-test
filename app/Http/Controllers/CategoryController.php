<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list()
    {
        $data = [
            'title' => 'List Users',
            'categories' => Category::orderBy("created_at", "desc")->paginate(10)
        ];

        return view('admin.categories.list', $data);
    }
}
