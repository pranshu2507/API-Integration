<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::all(); // Retrieve all comments

        return response()->json(['comments' => $comments]);
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
            'content' => 'required',
        ]);

        $comment = Comment::create($validatedData);

        return response()->json(['message' => 'Comment created successfully', 'comment' => $comment]);
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id);

        return response()->json(['comment' => $comment]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'content' => 'required',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($validatedData);

        return response()->json(['message' => 'Comment updated successfully', 'comment' => $comment]);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
