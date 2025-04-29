<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function main()
    {
        $categories = Category::all();
        $posts = Post::with('category', 'images')->latest()->get();
        $featuredPosts = Post::with('category', 'images')->latest()->take(5)->get();
        $latestPosts  = Post::with(['user', 'category'])
            ->withCount('comments')
            ->latest()
            ->take(6)
            ->get();

        return view('main', compact('categories', 'posts', 'featuredPosts','latestPosts'));
    }
}
