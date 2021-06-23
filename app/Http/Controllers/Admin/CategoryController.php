<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\PackageCategory as Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()->route('category.index')->withSuccess('Created successfully.');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return back()->withSuccess('Updated successfully.');
    }

    public function destroy($id)
    {
        Category::destroy($id);

        return back()->withSuccess('Deleted successfully.');
    }
}
