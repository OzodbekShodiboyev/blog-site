<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function latestNews(Request $request)
    {
        $posts = Post::with(['category', 'comments', 'likes.user', 'user'])
            ->whereNull('deleted_at')
            ->where('published_at', '<=', now())
            ->latest()
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('latest-news-posts', compact('posts'))->render(),
                'next_page' => $posts->nextPageUrl()
            ]);
        }

        return view('latest-news', compact('posts'));
    }


    public function addComment(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $post = Post::findOrFail($postId);

        $comment = new Comment([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        $post->comments()->save($comment);

        return response()->json([
            'userName' => Auth::user()->name,
            'content' => $comment->content,
        ]);
    }


    public function addLike($postId)
    {
        $post = Post::findOrFail($postId);

        $like = $post->likes()->where('user_id', Auth::id())->first();

        if ($like) {
            $like->delete();
        } else {
            $post->likes()->create(['user_id' => Auth::id()]);
        }

        return response()->json([
            'likeCount' => $post->likes->count(),
        ]);
    }

    public function show($id)
    {
        $post = Post::with(['images', 'likes', 'comments.user'])->findOrFail($id);


        return view('post.show', compact('post'));
    }
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:3|max:255',
        ]);

        $query = $request->input('query');

        $posts = Post::with('category')
            ->where('title', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->orWhereHas('category', function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'like', '%' . $query . '%');
            })
            ->latest()
            ->paginate(10);

        if ($posts->isEmpty()) {
            return back()->with('error', 'Bunday natijalar topilmadi!');
        }

        return view('post.search_results', compact('posts'));
    }
}
