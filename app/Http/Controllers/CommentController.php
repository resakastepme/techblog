<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string|min:3|max:500',
            // 'parent_id' => 'nullable|exists:comments,id' // Ensure valid comment ID for replies
        ]);

        // Check if parent_id exists and is not a reply itself (only 1 level deep)
        // if ($request->parent_id) {
        //     $parentComment = Comment::find($request->parent_id);
        //     if ($parentComment->parent_id) {
        //         return back()->withErrors(['parent_id' => 'Replies can only be one level deep.']);
        //     }
        // }

        Comment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'content' => $request->content,
            'parent_id' => $request->parent_id,
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    public function storeReply(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string|min:3|max:500',
            'parent_id' => 'nullable|exists:comments,id' // Ensure valid comment ID for replies
        ]);

        Comment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'content' => $request->content,
            'parent_id' => $request->parent_id,
        ]);

        return back()->with('success', 'Comment added successfully!');
    }
}
