<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = User::role('author')->with('categories')->get();
        return view('admin.author.index', compact('authors'));
    }
    public function edit(User $author)
    {
        $categories = Category::all();
        return view('admin.author.edit', compact('author', 'categories'));
    }

    public function assignCategories(Request $request, User $author)
{
    $validated = $request->validate([
        'categories' => 'required|array',
        'categories.*' => 'exists:categories,id',
    ]);

    $author->categories()->sync($validated['categories']);

    return redirect()->route('admin.authors')
                     ->with('success', 'Kategoriyalar muvaffaqiyatli biriktirildi.');
}
}
