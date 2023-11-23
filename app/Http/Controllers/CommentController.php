<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;
use App\Models\Comment;

class CommentController extends Controller
{
    public function getComments($blogId)
    {
        $comments = Comment::with( 'childrenRecursive')->where('blog_id', $blogId)->whereNull('parent_id')->get();
        return response()->json($comments);
    }

    public function saveComment(Request $request, $blogId)
    {
        $comment = Comment::create([
            'blog_id' => $blogId,
            'user_id' => $request->input('user_id'),
            'parent_id' => $request->input('parent_id'), // This will be null for top-level comments
            'content' => $request->input('content'),
        ]);

        return response()->json($comment, 201);
    }
    public function updateComment(Request $request, $commentID)
    {
        $comment = Comment::findOrFail($commentID);

        $comment->update([
            'content' => $request->input('content'),
        ]);

        return response()->json($comment, 200);
    }

    public function deleteComment($commentID)
    {
        $comment = Comment::findOrFail($commentID);
        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully'], 200);
    }
}
