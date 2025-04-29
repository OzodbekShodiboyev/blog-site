<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function latestNews()
    {
        $posts = Post::with('category', 'comments', 'likes.user', 'user')->latest()->get();


        return view('latest-news', compact('posts'));
    }

    public function addComment(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $post = Post::findOrFail($postId);
        $comment = new Comment([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        $post->comments()->save($comment);

        return back();
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

        return back();
    }
    public function show($id)
    {
        $post = Post::with(['images', 'likes', 'comments.user'])->findOrFail($id);


        return view('post.show', compact('post'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $posts = Post::where('title', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->get();

        return view('post.search_results', compact('posts'));
    }
}
