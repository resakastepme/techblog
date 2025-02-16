<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        return view('post.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:Artificial Intelligence,Cybersecurity,Software Development,Programming Languages,Web Development,Cloud Computing,Electronic Vehicles,Blockchain & Cryptocurrency,Gadgets & Hardware,Tech Industry News',
            'thumbnail' => 'required|string',
            'content' => 'required|string|min:10',
        ]);

        $post = new Post();
        $post->title = $validated['title'];
        $post->category = $validated['category'];
        $post->content = $validated['content'];
        $post->user_id = Auth::id();

        if ($validated['thumbnail']) {
            $userId = Auth::id();

            $randomString = Str::random(5) . time();
            $fileName = "{$randomString}.png";
            $path = "public/thumbnails/{$userId}/{$fileName}";

            $image = base64_decode(explode(',', $validated['thumbnail'])[1]);
            Storage::put($path, $image);

            $post->thumbnail = "/storage/thumbnails/{$userId}/{$fileName}";
        }

        $save = $post->save();

        if ($save) {
            return redirect()->to('/' . $post->id . '/view');
        } else {
            return redirect()->back()->with('status', 'Error');
        }
    }
    public function viewPost($id)
    {
        $data = Post::where('id', $id)->with(['user'])->first();
        $comments = Comment::where('post_id', $id)
            ->whereNull('parent_id')
            ->with(['user', 'replies.user'])
            ->orderBy('created_at', 'desc')
            ->get();
        $countComments = Comment::where('post_id', $id)->get();

        return view('post.view')->with([
            'data' => $data,
            'comments' => $comments,
            'countComments' => $countComments
        ]);
    }
    public function edit($id)
    {
        $q = Post::where('id', $id)->first();
        return view('post.edit')->with([
            'data' => $q
        ]);
    }
    public function updatePost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'content' => 'required|string',
            'thumbnail' => 'nullable|string',
        ]);

        $post = Post::findOrFail($request->id);

        if (!is_null($request->thumbnail) && Str::startsWith($request->thumbnail, 'data:image/')) {
            $thumbnailPath = public_path($post->thumbnail);
            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            }

            $imageData = explode(',', $request->thumbnail)[1];
            $directory = 'public/thumbnails/' . $request->id;
            Storage::makeDirectory($directory);
            $imageName = Str::random(5) . time() . '.png';
            Storage::put($directory . '/' . $imageName, base64_decode($imageData));

            $post->thumbnail = '/storage/thumbnails/' . $request->id . '/' . $imageName;
        }

        $post->title = $request->title;
        $post->category = $request->category;
        $post->content = $request->content;
        $post->save();

        return redirect()->to('/' . $request->id . '/view')->with('success', 'Post updated successfully!');
    }

    public function destroy(Request $r)
    {
        try {
            $post_id = $r['post_id'];

            $post = Post::findOrFail($post_id);

            $thumbnailPath = public_path($post->thumbnail);
            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            }

            Comment::where('post_id', $post_id)->delete();

            $post->delete();

            return redirect()->to('/')->with([
                'success' => 'Post has been deleted!'
            ]);
        } catch (\Throwable $th) {
            return back()->with([
                'error' => $th->getMessage()
            ]);
        }
    }
}
