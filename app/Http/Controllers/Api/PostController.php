<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// MODEL
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request){
        $posts = Post::with('type', 'technology')->paginate(3);

        return response()->json([
            'success' => true,
            'posts' => $posts,
        ]);
    }
}
