<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $users = User::all();
            $posts = Post::all();
            $categories = Category::all();
            $userCount = $users->count();
            $categoriesCount = $categories->count();
            $postCount = $posts->count();
            $userData = [
                'userCount' => $userCount,
                'categoriesCount' => $categoriesCount,
                'postCount' => $postCount,
            ];
            return view('admin.dashboard', compact('userData'));
        }else if($user->hasRole('author')) {
            return view('author.dashboard');
        }
    }
}
