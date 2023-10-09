<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'likeable_id' => 'required',
            'likeable_type' => 'required|in:post,comment',
        ]);

        // Create a new like
        $like = Like::create($request->all());

        return response()->json(['message' => 'Like created successfully', 'like' => $like]);
    }

    public function destroy(Like $like)
    {
        // Delete the like
        $like->delete();

        return response()->json(['message' => 'Like deleted successfully']);
    }
}
