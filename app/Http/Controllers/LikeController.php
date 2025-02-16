<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    // public function likePost(Post $post)
    // {
    //     $user = auth()->user();

    //     if ($post->likedByUsers()->where('user_id', $user->id)->exists()) {
    //         return response()->json(['message' => 'Already liked'], 400);
    //     }

    //     $post->likedByUsers()->attach($user->id);

    //     return response()->json(['message' => 'Post liked successfully']);
    // }

    // public function unlikePost(Post $post)
    // {
    //     $user = auth()->user();

    //     $post->likedByUsers()->detach($user->id);

    //     return response()->json(['message' => 'Post unliked successfully']);
    // }
    public function like(Post $post)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Check if the user already liked the post
        if (!$post->isLikedByUser()) {
            Like::create([
                'user_id' => auth()->id(),
                'post_id' => $post->id
            ]);
        }

        return response()->json([
            'success' => true,
            'likes_count' => $post->likes_count,
            'liked' => true
        ]);
    }

    public function unlike(Post $post)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Remove the like
        Like::where('user_id', auth()->id())->where('post_id', $post->id)->delete();

        return response()->json([
            'success' => true,
            'likes_count' => $post->likes_count,
            'liked' => false
        ]);
    }
}
