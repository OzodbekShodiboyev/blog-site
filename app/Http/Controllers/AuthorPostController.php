<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorPostController extends Controller
{
    public function create()
    {
        $categories = auth()->user()->categories;
        return view('author.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (!auth()->user()->categories->contains('id', $request->category_id)) {
            return back()->with('error', 'Sizga bu kategoriya ruxsat etilmagan.');
        }

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('posts', 'public');

                $post->images()->create([
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('author.posts.show')->with('success', 'Post muvaffaqiyatli yaratildi!');
    }
    public function show()
    {
        $posts = Post::where('user_id', auth()->id())->latest()->get();
        return view('author.posts.show', compact('posts'));
    }
    public function edit(Post $post)
    {
        if (auth()->id() !== $post->user_id) {
            abort(403, 'Siz bu postni tahrirlay olmaysiz.');
        }

        $categories = auth()->user()->categories;

        return view('author.posts.edit', compact('post', 'categories'));
    }
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store('posts', 'public');

                $post->images()->create([
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('author.posts.show')->with('success', 'Post muvaffaqiyatli yangilandi.');
    }
    public function destroy(Post $post)
{
    if ($post->user_id !== auth()->id()) {
        abort(403);
    }

    foreach ($post->images as $image) {
        if (Storage::disk('public')->exists($image->image_path)) {
            \Storage::disk('public')->delete($image->image_path);
        }
        $image->delete();
    }

    $post->delete();

    return redirect()->route('author.posts.show')->with('success', 'Post muvaffaqiyatli o‘chirildi.');
}

}
