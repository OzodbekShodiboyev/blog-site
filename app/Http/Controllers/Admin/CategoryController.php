<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);
        $categors = Category::all();

        return redirect()->route('admin.category')->with('success', 'Kategoriya muvaffaqiyatli yaratildi.');

    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.category')->with('success', 'Kategoriya muvaffaqiyatli yangilandi.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.category')->with('success', 'Kategoriya muvaffaqiyatli o‘chirildi.');
    }
}
