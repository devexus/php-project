<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('categories', ['categories' => $categories]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(string $category): View
    {
        $c = Category::find($category);
        return view('category.edit', ['category' => $c]);
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        Category::create($data);

        return redirect()->route('categories');
    }

    public function update(string $category, CategoryRequest $request)
    {
        $c = Category::find($category);

        $c->name = $request->name;
        $c->color = $request->color;

        $c->save();

        return redirect()->route('categories')->with('success', 'Category has been updated successfully');;
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories')->with('success', 'Category deleted successfully');
    }
}
