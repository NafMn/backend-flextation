<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('user')->get();
        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'commenter_name' => 'required',
            'content' => 'required',
            'kehadiran' => 'required|in:hadir,belum tahu,tidak hadir', // Validasi untuk 'kehadiran'
        ]);
      
        // return redirect()->route('comments.index')
        //                 ->with('success', 'Comment created successfully.');

        $comment = Comment::create($request->all());

        return response()->json($comment, 201)
        ->with('success', 'Comment created successfully.');
    }

    public function show(Comment $comment)
    {
        $comment->load('user'); 
        return response()->json($comment);
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'commenter_name' => 'required',
            'content' => 'required',
            'kehadiran' => 'required|in:hadir,belum tahu,tidak hadir', 
        ]);

        $comment->update($request->all());

        return response()->json($comment, 200);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json(null, 204);
    }
}

