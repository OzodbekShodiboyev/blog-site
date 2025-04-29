<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/**
 * @OA\Info(
 *     title="BLOG API",
 *     version="1.0.0",
 *     description="BLOG Application API documentation"
 * )
 */

class Postcontroller extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/posts",
     *     summary="Get all posts",
     *     tags={"Posts"},
     *     @OA\Response(
     *         response=200,
     *         description="A list of posts"
     *     )
     * )
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }
}
