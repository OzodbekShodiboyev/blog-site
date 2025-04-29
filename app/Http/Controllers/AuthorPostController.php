<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePostRequest;

class AuthorPostController extends Controller
{

    public function index()
    {
        if (!auth()->user()->hasRole('author')) {
            abort(403, 'Sizda bu sahifaga kirish huquqi yo‘q.');
        }

        $posts = Post::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('author.posts.index', compact('posts'));
    }
    public function create()
    {
        $categories = auth()->user()->categories;
        return view('author.posts.create', compact('categories'));
    }

    public function store(PostRequest $request)
    {
        DB::beginTransaction();

        try {
            if (!auth()->user()->categories->contains('id', $request->category_id)) {
                return back()->with('error', 'Sizga bu kategoriya ruxsat etilmagan.');
            }
            $nowDate = date("Y-m-d h:i:s");
            // dd($nowDate);
            $post = Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'user_id' => auth()->id(),
                'published_at' => $request->input('published_at') ?: now(),

            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('posts', 'public');
                    $post->images()->create([
                        'image_path' => $path,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('author.posts.show')->with('success', 'Post muvaffaqiyatli yaratildi!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Post yaratishda xato: ' . $e->getMessage());
            return back()->with('error', 'Post yaratishda xatolik yuz berdi.');
        }
    }


    public function edit(Post $post)
    {
        if (auth()->id() !== $post->user_id) {
            abort(403, 'Siz bu postni tahrirlay olmaysiz.');
        }

        $canEditPublishedAt = $post->published_at && $post->published_at > now();

        $categories = auth()->user()->categories;

        return view('author.posts.edit', compact('post', 'categories', 'canEditPublishedAt'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Siz bu postni yangilay olmaysiz.');
        }

        DB::beginTransaction();

        try {
            if ($post->published_at && $post->published_at > now() && $request->has('published_at')) {
                $post->published_at = $request->published_at;
            }

            $post->update([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id,
            ]);

            // Rasmlarni yangilash
            if ($request->hasFile('images')) {
                foreach ($post->images as $image) {
                    if (Storage::disk('public')->exists($image->image_path)) {
                        Storage::disk('public')->delete($image->image_path);
                    }
                    $image->delete();
                }

                foreach ($request->file('images') as $imageFile) {
                    $path = $imageFile->store('posts', 'public');

                    $post->images()->create([
                        'image_path' => $path,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('author.posts.show')->with('success', 'Post muvaffaqiyatli yangilandi!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Post yangilanishda xato: ' . $e->getMessage());
            return back()->with('error', 'Post yangilanishda xatolik yuz berdi.');
        }
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Siz bu postni o\'chirib bo\'lmaysiz.');
        }

        DB::beginTransaction();

        try {
            foreach ($post->images as $image) {
                if (Storage::disk('public')->exists($image->image_path)) {
                    Storage::disk('public')->delete($image->image_path);
                }
                $image->delete();
            }

            $post->delete();

            DB::commit();

            return redirect()->route('author.posts.show')->with('success', 'Post muvaffaqiyatli o\'chirildi.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Post o\'chirishda xato: ' . $e->getMessage());

            return back()->with('error', 'Postni o\'chirishda xatolik yuz berdi.');
        }
    }
}
