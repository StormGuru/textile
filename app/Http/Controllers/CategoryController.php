<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function show()
    {
        $categories = Category::all();
        return $categories;
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);
        
        return $category;
    }

    public function delete(Category $category)
    {
       
        $category->delete();
        
        return response([]);
       
    }

    public function add(CategoryRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);
        return $category;
    }
}

