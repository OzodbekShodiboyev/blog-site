<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categors = Category::all();
        return view('admin.category.index', compact('categors'));
    }
    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()->route('admin.category')->with('success', 'Kategoriya muvaffaqiyatli yaratildi.');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route('admin.category')->with('success', 'Kategoriya muvaffaqiyatli yangilandi.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.category')->with('success', 'Kategoriya muvaffaqiyatli o‘chirildi.');
    }
}
