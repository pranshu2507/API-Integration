<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; 

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get();
        return response()->json(['posts' => $posts]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'content' => 'required',
            'image' => 'nullable|image',
        ]);

        // Handle image upload and post creation here

        return response()->json(['message' => 'Post created successfully']);
    }
}
